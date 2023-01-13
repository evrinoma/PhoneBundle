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

namespace Evrinoma\PhoneBundle\DtoCommon\ValueObject\Mutable;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\PhoneBundle\Dto\PhoneApiDtoInterface;
use Evrinoma\PhoneBundle\DtoCommon\ValueObject\Immutable\PhoneApiDtoTrait as PhoneApiDtoImmutableTrait;

trait PhoneApiDtoTrait
{
    use PhoneApiDtoImmutableTrait;

    public function setPhoneApiDto(PhoneApiDtoInterface $phoneApiDto): DtoInterface
    {
        $this->phoneApiDto = $phoneApiDto;

        return $this;
    }
}
