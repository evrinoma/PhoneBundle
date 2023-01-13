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

namespace Evrinoma\PhoneBundle\Factory\Phone;

use Evrinoma\PhoneBundle\Dto\PhoneApiDtoInterface;
use Evrinoma\PhoneBundle\Model\Phone\PhoneInterface;

interface FactoryInterface
{
    /**
     * @param PhoneApiDtoInterface $dto
     *
     * @return PhoneInterface
     */
    public function create(PhoneApiDtoInterface $dto): PhoneInterface;
}
