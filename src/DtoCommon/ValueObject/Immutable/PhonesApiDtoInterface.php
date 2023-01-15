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

namespace Evrinoma\PhoneBundle\DtoCommon\ValueObject\Immutable;

use Evrinoma\PhoneBundle\Dto\PhoneApiDtoInterface as BasePhoneApiDtoInterface;

interface PhonesApiDtoInterface
{
    public const PHONES = BasePhoneApiDtoInterface::PHONES;

    public function hasPhonesApiDto(): bool;

    public function getPhonesApiDto(): array;
}
