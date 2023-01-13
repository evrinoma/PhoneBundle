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

namespace Evrinoma\PhoneBundle\Model\Phone;

use Evrinoma\UtilsBundle\Entity\CreateUpdateAtInterface;
use Evrinoma\UtilsBundle\Entity\DescriptionInterface;
use Evrinoma\UtilsBundle\Entity\IdInterface;

interface PhoneInterface extends CreateUpdateAtInterface, IdInterface, DescriptionInterface
{
    public function getCountry(): string;

    public function setCountry(string $country): PhoneInterface;

    public function getCode(): string;

    public function setCode(string $code): PhoneInterface;

    public function getNumber(): string;

    public function setNumber(string $number): PhoneInterface;
}
