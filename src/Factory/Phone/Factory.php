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
use Evrinoma\PhoneBundle\Entity\Phone\BasePhone;
use Evrinoma\PhoneBundle\Model\Phone\PhoneInterface;

class Factory implements FactoryInterface
{
    private static string $entityClass = BasePhone::class;

    public function __construct(string $entityClass)
    {
        self::$entityClass = $entityClass;
    }

    /**
     * @param PhoneApiDtoInterface $dto
     *
     * @return PhoneInterface
     */
    public function create(PhoneApiDtoInterface $dto): PhoneInterface
    {
        /* @var BasePhone $phone */
        return new self::$entityClass();
    }
}
