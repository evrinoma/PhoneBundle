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

namespace Evrinoma\PhoneBundle\DtoCommon\ValueObject\Preserve;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\PhoneBundle\Dto\PhoneApiDtoInterface;

trait PhonesApiDtoTrait
{
    public function addPhonesApiDto(PhoneApiDtoInterface $phonesApiDto): DtoInterface
    {
        return parent::addPhonesApiDto($phonesApiDto);
    }
}
