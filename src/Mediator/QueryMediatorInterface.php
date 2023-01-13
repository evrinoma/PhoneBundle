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

namespace Evrinoma\PhoneBundle\Mediator;

use Evrinoma\PhoneBundle\Dto\PhoneApiDtoInterface;
use Evrinoma\UtilsBundle\QueryBuilder\QueryBuilderInterface;

interface QueryMediatorInterface
{
    /**
     * @return string
     */
    public function alias(): string;

    /**
     * @param PhoneApiDtoInterface  $dto
     * @param QueryBuilderInterface $builder
     *
     * @return mixed
     */
    public function createQuery(PhoneApiDtoInterface $dto, QueryBuilderInterface $builder): void;

    /**
     * @param PhoneApiDtoInterface  $dto
     * @param QueryBuilderInterface $builder
     *
     * @return array
     */
    public function getResult(PhoneApiDtoInterface $dto, QueryBuilderInterface $builder): array;
}
