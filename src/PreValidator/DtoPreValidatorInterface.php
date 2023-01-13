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

namespace Evrinoma\PhoneBundle\PreValidator;

use Evrinoma\PhoneBundle\Dto\PhoneApiDtoInterface;
use Evrinoma\PhoneBundle\Exception\PhoneInvalidException;

interface DtoPreValidatorInterface
{
    /**
     * @param PhoneApiDtoInterface $dto
     *
     * @throws PhoneInvalidException
     */
    public function onPost(PhoneApiDtoInterface $dto): void;

    /**
     * @param PhoneApiDtoInterface $dto
     *
     * @throws PhoneInvalidException
     */
    public function onPut(PhoneApiDtoInterface $dto): void;

    /**
     * @param PhoneApiDtoInterface $dto
     *
     * @throws PhoneInvalidException
     */
    public function onDelete(PhoneApiDtoInterface $dto): void;
}
