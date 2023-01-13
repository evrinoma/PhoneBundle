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

namespace Evrinoma\PhoneBundle\Serializer;

interface GroupInterface
{
    public const API_POST_PHONE = 'API_POST_PHONE';
    public const API_PUT_PHONE = 'API_PUT_PHONE';
    public const API_GET_PHONE = 'API_GET_PHONE';
    public const API_CRITERIA_PHONE = self::API_GET_PHONE;
    public const APP_GET_BASIC_PHONE = 'APP_GET_BASIC_PHONE';
}
