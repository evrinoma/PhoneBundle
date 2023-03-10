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

namespace Evrinoma\PhoneBundle\DependencyInjection\Compiler\Constraint\Property;

use Evrinoma\PhoneBundle\Validator\PhoneValidator;
use Evrinoma\UtilsBundle\DependencyInjection\Compiler\AbstractConstraint;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class PhonePass extends AbstractConstraint implements CompilerPassInterface
{
    public const PHONE_CONSTRAINT = 'evrinoma.phone.constraint.property';

    protected static string $alias = self::PHONE_CONSTRAINT;
    protected static string $class = PhoneValidator::class;
    protected static string $methodCall = 'addPropertyConstraint';
}
