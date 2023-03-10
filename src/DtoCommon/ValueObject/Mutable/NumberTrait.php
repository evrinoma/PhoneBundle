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
use Evrinoma\PhoneBundle\DtoCommon\ValueObject\Immutable\NumberTrait as NumberImmutableTrait;

trait NumberTrait
{
    use NumberImmutableTrait;

    /**
     * @param string $number
     *
     * @return DtoInterface
     */
    protected function setNumber(string $number): DtoInterface
    {
        $this->number = trim($number);

        return $this;
    }
}
