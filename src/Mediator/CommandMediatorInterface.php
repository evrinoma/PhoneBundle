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

use Evrinoma\PhoneBundle\Dto\PhoneApiDtoInterface;
use Evrinoma\PhoneBundle\Exception\PhoneCannotBeCreatedException;
use Evrinoma\PhoneBundle\Exception\PhoneCannotBeRemovedException;
use Evrinoma\PhoneBundle\Exception\PhoneCannotBeSavedException;
use Evrinoma\PhoneBundle\Model\Phone\PhoneInterface;

interface CommandMediatorInterface
{
    /**
     * @param PhoneApiDtoInterface $dto
     * @param PhoneInterface       $entity
     *
     * @return PhoneInterface
     *
     * @throws PhoneCannotBeSavedException
     */
    public function onUpdate(PhoneApiDtoInterface $dto, PhoneInterface $entity): PhoneInterface;

    /**
     * @param PhoneApiDtoInterface $dto
     * @param PhoneInterface       $entity
     *
     * @throws PhoneCannotBeRemovedException
     */
    public function onDelete(PhoneApiDtoInterface $dto, PhoneInterface $entity): void;

    /**
     * @param PhoneApiDtoInterface $dto
     * @param PhoneInterface       $entity
     *
     * @return PhoneInterface
     *
     * @throws PhoneCannotBeSavedException
     * @throws PhoneCannotBeCreatedException
     */
    public function onCreate(PhoneApiDtoInterface $dto, PhoneInterface $entity): PhoneInterface;
}
