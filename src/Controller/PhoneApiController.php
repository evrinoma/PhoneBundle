<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\PhoneBundle\Controller;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Evrinoma\DtoBundle\Factory\FactoryDtoInterface;
use Evrinoma\PhoneBundle\Dto\PhoneApiDtoInterface;
use Evrinoma\PhoneBundle\Exception\PhoneCannotBeSavedException;
use Evrinoma\PhoneBundle\Exception\PhoneInvalidException;
use Evrinoma\PhoneBundle\Exception\PhoneNotFoundException;
use Evrinoma\PhoneBundle\Facade\Phone\FacadeInterface;
use Evrinoma\PhoneBundle\Serializer\GroupInterface;
use Evrinoma\UtilsBundle\Controller\AbstractWrappedApiController;
use Evrinoma\UtilsBundle\Controller\ApiControllerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use JMS\Serializer\SerializerInterface;
use OpenApi\Annotations as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final class PhoneApiController extends AbstractWrappedApiController implements ApiControllerInterface
{
    private string $dtoClass;

    private ?Request $request;

    private FactoryDtoInterface $factoryDto;

    private FacadeInterface $facade;

    public function __construct(
        SerializerInterface $serializer,
        RequestStack $requestStack,
        FactoryDtoInterface $factoryDto,
        FacadeInterface $facade,
        string $dtoClass
    ) {
        parent::__construct($serializer);
        $this->request = $requestStack->getCurrentRequest();
        $this->factoryDto = $factoryDto;
        $this->dtoClass = $dtoClass;
        $this->facade = $facade;
    }

    /**
     * @Rest\Post("/api/phone/create", options={"expose": true}, name="api_phone_create")
     * @OA\Post(
     *     tags={"phone"},
     *     description="the method perform create phone",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "class": "Evrinoma\PhoneBundle\Dto\PhoneApiDto",
     *                     "country": "+7",
     *                     "code": "495",
     *                     "number": "78907890",
     *                 },
     *                 type="object",
     *                 @OA\Property(property="class", type="string", default="Evrinoma\PhoneBundle\Dto\PhoneApiDto"),
     *                 @OA\Property(property="country", type="string"),
     *                 @OA\Property(property="code", type="string"),
     *                 @OA\Property(property="number", type="string"),
     *             )
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Create phone")
     *
     * @return JsonResponse
     */
    public function postAction(): JsonResponse
    {
        /** @var PhoneApiDtoInterface $phoneApiDto */
        $phoneApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $this->setStatusCreated();

        $json = [];
        $error = [];
        $group = GroupInterface::API_POST_PHONE;

        try {
            $this->facade->post($phoneApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Create phone', $json, $error);
    }

    /**
     * @Rest\Put("/api/phone/save", options={"expose": true}, name="api_phone_save")
     * @OA\Put(
     *     tags={"phone"},
     *     description="the method perform save phone for current entity",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 example={
     *                     "class": "Evrinoma\PhoneBundle\Dto\PhoneApiDto",
     *                     "id": "2",
     *                     "country": "+7",
     *                     "code": "495",
     *                     "number": "78907890",
     *                 },
     *                 type="object",
     *                 @OA\Property(property="class", type="string", default="Evrinoma\PhoneBundle\Dto\PhoneApiDto"),
     *                 @OA\Property(property="id", type="string"),
     *                 @OA\Property(property="country", type="string"),
     *                 @OA\Property(property="code", type="string"),
     *                 @OA\Property(property="number", type="string"),
     *             )
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Save phone")
     *
     * @return JsonResponse
     */
    public function putAction(): JsonResponse
    {
        /** @var PhoneApiDtoInterface $phoneApiDto */
        $phoneApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_PUT_PHONE;

        try {
            $this->facade->put($phoneApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Save phone', $json, $error);
    }

    /**
     * @Rest\Delete("/api/phone/delete", options={"expose": true}, name="api_phone_delete")
     * @OA\Delete(
     *     tags={"phone"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\PhoneBundle\Dto\PhoneApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="3",
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Delete phone")
     *
     * @return JsonResponse
     */
    public function deleteAction(): JsonResponse
    {
        /** @var PhoneApiDtoInterface $phoneApiDto */
        $phoneApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $this->setStatusAccepted();

        $json = [];
        $error = [];

        try {
            $this->facade->delete($phoneApiDto, '', $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->JsonResponse('Delete phone', $json, $error);
    }

    /**
     * @Rest\Get("/api/phone/criteria", options={"expose": true}, name="api_phone_criteria")
     * @OA\Get(
     *     tags={"phone"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\PhoneBundle\Dto\PhoneApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="number",
     *         in="query",
     *         name="number",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="country",
     *         in="query",
     *         name="country",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Country Code",
     *         in="query",
     *         name="code",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     * )
     * @OA\Response(response=200, description="Return phone")
     *
     * @return JsonResponse
     */
    public function criteriaAction(): JsonResponse
    {
        /** @var PhoneApiDtoInterface $phoneApiDto */
        $phoneApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_CRITERIA_PHONE;

        try {
            $this->facade->criteria($phoneApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Get phone', $json, $error);
    }

    /**
     * @Rest\Get("/api/phone", options={"expose": true}, name="api_phone")
     * @OA\Get(
     *     tags={"phone"},
     *     @OA\Parameter(
     *         description="class",
     *         in="query",
     *         name="class",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="Evrinoma\PhoneBundle\Dto\PhoneApiDto",
     *             readOnly=true
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="id Entity",
     *         in="query",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="3",
     *         )
     *     )
     * )
     * @OA\Response(response=200, description="Return phone")
     *
     * @return JsonResponse
     */
    public function getAction(): JsonResponse
    {
        /** @var PhoneApiDtoInterface $phoneApiDto */
        $phoneApiDto = $this->factoryDto->setRequest($this->request)->createDto($this->dtoClass);

        $json = [];
        $error = [];
        $group = GroupInterface::API_GET_PHONE;

        try {
            $this->facade->get($phoneApiDto, $group, $json);
        } catch (\Exception $e) {
            $error = $this->setRestStatus($e);
        }

        return $this->setSerializeGroup($group)->JsonResponse('Get phone', $json, $error);
    }

    /**
     * @param \Exception $e
     *
     * @return array
     */
    public function setRestStatus(\Exception $e): array
    {
        switch (true) {
            case $e instanceof PhoneCannotBeSavedException:
                $this->setStatusNotImplemented();
                break;
            case $e instanceof UniqueConstraintViolationException:
                $this->setStatusConflict();
                break;
            case $e instanceof PhoneNotFoundException:
                $this->setStatusNotFound();
                break;
            case $e instanceof PhoneInvalidException:
                $this->setStatusUnprocessableEntity();
                break;
            default:
                $this->setStatusBadRequest();
        }

        return [$e->getMessage()];
    }
}
