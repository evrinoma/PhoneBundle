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

namespace Evrinoma\PhoneBundle\Dto\Preserve;

use Evrinoma\DtoCommon\ValueObject\Mutable\DescriptionInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\IdInterface;
use Evrinoma\PhoneBundle\DtoCommon\ValueObject\Mutable\CodeInterface;
use Evrinoma\PhoneBundle\DtoCommon\ValueObject\Mutable\CountryInterface;
use Evrinoma\PhoneBundle\DtoCommon\ValueObject\Mutable\NumberInterface;

interface PhoneApiDtoInterface extends IdInterface, CodeInterface, CountryInterface, NumberInterface, DescriptionInterface
{
}
