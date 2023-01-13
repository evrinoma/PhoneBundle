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

namespace Evrinoma\PhoneBundle\Tests\Functional\ValueObject\Phone;

use Evrinoma\TestUtilsBundle\ValueObject\Common\AbstractIdentity;

class Country extends AbstractIdentity
{
    protected static string $value = '+7';
    protected static string $default = '+49';
}
