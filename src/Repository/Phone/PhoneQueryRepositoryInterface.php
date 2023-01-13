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

namespace Evrinoma\PhoneBundle\Repository\Phone;

use Doctrine\ORM\Exception\ORMException;
use Evrinoma\PhoneBundle\Dto\PhoneApiDtoInterface;
use Evrinoma\PhoneBundle\Exception\PhoneNotFoundException;
use Evrinoma\PhoneBundle\Exception\PhoneProxyException;
use Evrinoma\PhoneBundle\Model\Phone\PhoneInterface;

interface PhoneQueryRepositoryInterface
{
    /**
     * @param PhoneApiDtoInterface $dto
     *
     * @return array
     *
     * @throws PhoneNotFoundException
     */
    public function findByCriteria(PhoneApiDtoInterface $dto): array;

    /**
     * @param string $id
     * @param null   $lockMode
     * @param null   $lockVersion
     *
     * @return PhoneInterface
     *
     * @throws PhoneNotFoundException
     */
    public function find(string $id, $lockMode = null, $lockVersion = null): PhoneInterface;

    /**
     * @param string $id
     *
     * @return PhoneInterface
     *
     * @throws PhoneProxyException
     * @throws ORMException
     */
    public function proxy(string $id): PhoneInterface;
}
