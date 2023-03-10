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

use Evrinoma\DtoCommon\ValueObject\Preserve\DescriptionTrait;
use Evrinoma\DtoCommon\ValueObject\Preserve\IdTrait;
use Evrinoma\PhoneBundle\DtoCommon\ValueObject\Preserve\CodeTrait;
use Evrinoma\PhoneBundle\DtoCommon\ValueObject\Preserve\CountryTrait;
use Evrinoma\PhoneBundle\DtoCommon\ValueObject\Preserve\NumberTrait;

trait PhoneApiDtoTrait
{
    use CodeTrait;
    use CountryTrait;
    use DescriptionTrait;
    use IdTrait;
    use NumberTrait;
}
