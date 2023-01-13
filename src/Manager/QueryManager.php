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

namespace Evrinoma\PhoneBundle\Manager;

use Evrinoma\PhoneBundle\Dto\PhoneApiDtoInterface;
use Evrinoma\PhoneBundle\Exception\PhoneNotFoundException;
use Evrinoma\PhoneBundle\Exception\PhoneProxyException;
use Evrinoma\PhoneBundle\Model\Phone\PhoneInterface;
use Evrinoma\PhoneBundle\Repository\Phone\PhoneQueryRepositoryInterface;

final class QueryManager implements QueryManagerInterface
{
    private PhoneQueryRepositoryInterface $repository;

    public function __construct(PhoneQueryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param PhoneApiDtoInterface $dto
     *
     * @return array
     *
     * @throws PhoneNotFoundException
     */
    public function criteria(PhoneApiDtoInterface $dto): array
    {
        try {
            $phone = $this->repository->findByCriteria($dto);
        } catch (PhoneNotFoundException $e) {
            throw $e;
        }

        return $phone;
    }

    /**
     * @param PhoneApiDtoInterface $dto
     *
     * @return PhoneInterface
     *
     * @throws PhoneProxyException
     */
    public function proxy(PhoneApiDtoInterface $dto): PhoneInterface
    {
        try {
            if ($dto->hasId()) {
                $phone = $this->repository->proxy($dto->idToString());
            } else {
                throw new PhoneProxyException('Id value is not set while trying get proxy object');
            }
        } catch (PhoneProxyException $e) {
            throw $e;
        }

        return $phone;
    }

    /**
     * @param PhoneApiDtoInterface $dto
     *
     * @return PhoneInterface
     *
     * @throws PhoneNotFoundException
     */
    public function get(PhoneApiDtoInterface $dto): PhoneInterface
    {
        try {
            $phone = $this->repository->find($dto->idToString());
        } catch (PhoneNotFoundException $e) {
            throw $e;
        }

        return $phone;
    }
}
