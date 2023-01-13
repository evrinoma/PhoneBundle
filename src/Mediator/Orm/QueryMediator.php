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

namespace Evrinoma\PhoneBundle\Mediator\Orm;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\PhoneBundle\Dto\PhoneApiDtoInterface;
use Evrinoma\PhoneBundle\Mediator\QueryMediatorInterface;
use Evrinoma\PhoneBundle\Repository\AliasInterface;
use Evrinoma\UtilsBundle\Mediator\AbstractQueryMediator;
use Evrinoma\UtilsBundle\Mediator\Orm\QueryMediatorTrait;
use Evrinoma\UtilsBundle\QueryBuilder\QueryBuilderInterface;

class QueryMediator extends AbstractQueryMediator implements QueryMediatorInterface
{
    use QueryMediatorTrait;

    protected static string $alias = AliasInterface::PHONE;

    /**
     * @param DtoInterface          $dto
     * @param QueryBuilderInterface $builder
     *
     * @return mixed
     */
    public function createQuery(DtoInterface $dto, QueryBuilderInterface $builder): void
    {
        $alias = $this->alias();

        /** @var $dto PhoneApiDtoInterface */
        if ($dto->hasId()) {
            $builder
                ->andWhere($alias.'.id = :id')
                ->setParameter('id', $dto->getId());
        }

        if ($dto->hasDescription()) {
            $builder
                ->andWhere($alias.'.description like :description')
                ->setParameter('description', '%'.$dto->getDescription().'%');
        }

        if ($dto->hasNumber()) {
            $builder
                ->andWhere($alias.'.number like :number')
                ->setParameter('number', '%'.$dto->getNumber().'%');
        }

        if ($dto->hasCountry()) {
            $builder
                ->andWhere($alias.'.country like :country')
                ->setParameter('country', '%'.$dto->getCountry().'%');
        }

        if ($dto->hasCode()) {
            $builder
                ->andWhere($alias.'.code like :code')
                ->setParameter('code', '%'.$dto->getCode().'%');
        }
    }
}
