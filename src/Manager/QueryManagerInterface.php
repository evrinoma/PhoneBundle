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

namespace Evrinoma\PhoneBundle\Manager;

use Evrinoma\PhoneBundle\Dto\PhoneApiDtoInterface;
use Evrinoma\PhoneBundle\Exception\PhoneNotFoundException;
use Evrinoma\PhoneBundle\Exception\PhoneProxyException;
use Evrinoma\PhoneBundle\Model\Phone\PhoneInterface;

interface QueryManagerInterface
{
    /**
     * @param PhoneApiDtoInterface $dto
     *
     * @return array
     *
     * @throws PhoneNotFoundException
     */
    public function criteria(PhoneApiDtoInterface $dto): array;

    /**
     * @param PhoneApiDtoInterface $dto
     *
     * @return PhoneInterface
     *
     * @throws PhoneNotFoundException
     */
    public function get(PhoneApiDtoInterface $dto): PhoneInterface;

    /**
     * @param PhoneApiDtoInterface $dto
     *
     * @return PhoneInterface
     *
     * @throws PhoneProxyException
     */
    public function proxy(PhoneApiDtoInterface $dto): PhoneInterface;
}
