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

namespace Evrinoma\PhoneBundle\Entity\Phone;

use Doctrine\ORM\Mapping as ORM;
use Evrinoma\PhoneBundle\Model\Phone\AbstractPhone;

/**
 * @ORM\Table(name="e_phone")
 * @ORM\Entity
 */
class BasePhone extends AbstractPhone
{
}
