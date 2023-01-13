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
use Evrinoma\PhoneBundle\Exception\PhoneCannotBeCreatedException;
use Evrinoma\PhoneBundle\Exception\PhoneCannotBeRemovedException;
use Evrinoma\PhoneBundle\Exception\PhoneCannotBeSavedException;
use Evrinoma\PhoneBundle\Exception\PhoneInvalidException;
use Evrinoma\PhoneBundle\Exception\PhoneNotFoundException;
use Evrinoma\PhoneBundle\Factory\Phone\FactoryInterface;
use Evrinoma\PhoneBundle\Mediator\CommandMediatorInterface;
use Evrinoma\PhoneBundle\Model\Phone\PhoneInterface;
use Evrinoma\PhoneBundle\Repository\Phone\PhoneRepositoryInterface;
use Evrinoma\UtilsBundle\Validator\ValidatorInterface;

final class CommandManager implements CommandManagerInterface
{
    private PhoneRepositoryInterface $repository;
    private ValidatorInterface            $validator;
    private FactoryInterface           $factory;
    private CommandMediatorInterface      $mediator;

    /**
     * @param ValidatorInterface       $validator
     * @param PhoneRepositoryInterface $repository
     * @param FactoryInterface         $factory
     * @param CommandMediatorInterface $mediator
     */
    public function __construct(ValidatorInterface $validator, PhoneRepositoryInterface $repository, FactoryInterface $factory, CommandMediatorInterface $mediator)
    {
        $this->validator = $validator;
        $this->repository = $repository;
        $this->factory = $factory;
        $this->mediator = $mediator;
    }

    /**
     * @param PhoneApiDtoInterface $dto
     *
     * @return PhoneInterface
     *
     * @throws PhoneInvalidException
     * @throws PhoneCannotBeCreatedException
     * @throws PhoneCannotBeSavedException
     */
    public function post(PhoneApiDtoInterface $dto): PhoneInterface
    {
        $phone = $this->factory->create($dto);

        $this->mediator->onCreate($dto, $phone);

        $errors = $this->validator->validate($phone);

        if (\count($errors) > 0) {
            $errorsString = (string) $errors;

            throw new PhoneInvalidException($errorsString);
        }

        $this->repository->save($phone);

        return $phone;
    }

    /**
     * @param PhoneApiDtoInterface $dto
     *
     * @return PhoneInterface
     *
     * @throws PhoneInvalidException
     * @throws PhoneNotFoundException
     * @throws PhoneCannotBeSavedException
     */
    public function put(PhoneApiDtoInterface $dto): PhoneInterface
    {
        try {
            $phone = $this->repository->find($dto->idToString());
        } catch (PhoneNotFoundException $e) {
            throw $e;
        }

        $this->mediator->onUpdate($dto, $phone);

        $errors = $this->validator->validate($phone);

        if (\count($errors) > 0) {
            $errorsString = (string) $errors;

            throw new PhoneInvalidException($errorsString);
        }

        $this->repository->save($phone);

        return $phone;
    }

    /**
     * @param PhoneApiDtoInterface $dto
     *
     * @throws PhoneCannotBeRemovedException
     * @throws PhoneNotFoundException
     */
    public function delete(PhoneApiDtoInterface $dto): void
    {
        try {
            $phone = $this->repository->find($dto->idToString());
        } catch (PhoneNotFoundException $e) {
            throw $e;
        }
        $this->mediator->onDelete($dto, $phone);
        try {
            $this->repository->remove($phone);
        } catch (PhoneCannotBeRemovedException $e) {
            throw $e;
        }
    }
}
