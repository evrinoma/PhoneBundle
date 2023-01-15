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

namespace Evrinoma\PhoneBundle\Dto;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\Immutable\DescriptionInterface;
use Evrinoma\DtoCommon\ValueObject\Immutable\IdInterface;
use Evrinoma\PhoneBundle\DtoCommon\ValueObject\Immutable\CodeInterface;
use Evrinoma\PhoneBundle\DtoCommon\ValueObject\Immutable\CountryInterface;
use Evrinoma\PhoneBundle\DtoCommon\ValueObject\Immutable\NumberInterface;

interface PhoneApiDtoInterface extends DtoInterface, IdInterface, CodeInterface, CountryInterface, NumberInterface, DescriptionInterface
{
    public const PHONE = 'phone';
    public const PHONES = PhoneApiDtoInterface::PHONE.'s';
}
