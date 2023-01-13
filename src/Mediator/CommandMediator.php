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

namespace Evrinoma\PhoneBundle\Mediator;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\PhoneBundle\Dto\PhoneApiDtoInterface;
use Evrinoma\PhoneBundle\Model\Phone\PhoneInterface;
use Evrinoma\UtilsBundle\Mediator\AbstractCommandMediator;

class CommandMediator extends AbstractCommandMediator implements CommandMediatorInterface
{
    public function onUpdate(DtoInterface $dto, $entity): PhoneInterface
    {
        /* @var $dto PhoneApiDtoInterface */
        $entity
            ->setCountry($dto->getCountry())
            ->setCode($dto->getCode())
            ->setNumber($dto->getNumber())
            ->setUpdatedAt(new \DateTimeImmutable());

        if ($dto->hasDescription()) {
            $entity->setDescription($dto->getDescription());
        }

        return $entity;
    }

    public function onDelete(DtoInterface $dto, $entity): void
    {
    }

    public function onCreate(DtoInterface $dto, $entity): PhoneInterface
    {
        /* @var $dto PhoneApiDtoInterface */
        $entity
            ->setCountry($dto->getCountry())
            ->setCode($dto->getCode())
            ->setNumber($dto->getNumber())
            ->setCreatedAt(new \DateTimeImmutable());

        if ($dto->hasDescription()) {
            $entity->setDescription($dto->getDescription());
        }

        return $entity;
    }
}
