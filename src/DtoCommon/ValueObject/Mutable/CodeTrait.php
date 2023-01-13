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
use Evrinoma\PhoneBundle\DtoCommon\ValueObject\Immutable\CodeTrait as CodeImmutableTrait;

trait CodeTrait
{
    use CodeImmutableTrait;

    protected function setCode(string $code): DtoInterface
    {
        $this->code = trim($code);

        return $this;
    }
}
