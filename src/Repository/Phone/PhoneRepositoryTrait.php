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
use Doctrine\ORM\ORMInvalidArgumentException;
use Evrinoma\PhoneBundle\Dto\PhoneApiDtoInterface;
use Evrinoma\PhoneBundle\Exception\PhoneCannotBeRemovedException;
use Evrinoma\PhoneBundle\Exception\PhoneCannotBeSavedException;
use Evrinoma\PhoneBundle\Exception\PhoneNotFoundException;
use Evrinoma\PhoneBundle\Exception\PhoneProxyException;
use Evrinoma\PhoneBundle\Mediator\QueryMediatorInterface;
use Evrinoma\PhoneBundle\Model\Phone\PhoneInterface;

trait PhoneRepositoryTrait
{
    private QueryMediatorInterface $mediator;

    /**
     * @param PhoneInterface $phone
     *
     * @return bool
     *
     * @throws PhoneCannotBeSavedException
     * @throws ORMException
     */
    public function save(PhoneInterface $phone): bool
    {
        try {
            $this->persistWrapped($phone);
        } catch (ORMInvalidArgumentException $e) {
            throw new PhoneCannotBeSavedException($e->getMessage());
        }

        return true;
    }

    /**
     * @param PhoneInterface $phone
     *
     * @return bool
     */
    public function remove(PhoneInterface $phone): bool
    {
        try {
            $this->getEntityManager()->remove($phone);
        } catch (ORMInvalidArgumentException $e) {
            throw new PhoneCannotBeRemovedException($e->getMessage());
        }

        return true;
    }

    /**
     * @param PhoneApiDtoInterface $dto
     *
     * @return array
     *
     * @throws PhoneNotFoundException
     */
    public function findByCriteria(PhoneApiDtoInterface $dto): array
    {
        $builder = $this->createQueryBuilderWrapped($this->mediator->alias());

        $this->mediator->createQuery($dto, $builder);

        $phones = $this->mediator->getResult($dto, $builder);

        if (0 === \count($phones)) {
            throw new PhoneNotFoundException('Cannot find phone by findByCriteria');
        }

        return $phones;
    }

    /**
     * @param      $id
     * @param null $lockMode
     * @param null $lockVersion
     *
     * @return mixed
     *
     * @throws PhoneNotFoundException
     */
    public function find($id, $lockMode = null, $lockVersion = null): PhoneInterface
    {
        /** @var PhoneInterface $phone */
        $phone = $this->findWrapped($id);

        if (null === $phone) {
            throw new PhoneNotFoundException("Cannot find phone with id $id");
        }

        return $phone;
    }

    /**
     * @param string $id
     *
     * @return PhoneInterface
     *
     * @throws PhoneProxyException
     * @throws ORMException
     */
    public function proxy(string $id): PhoneInterface
    {
        $phone = $this->referenceWrapped($id);

        if (!$this->containsWrapped($phone)) {
            throw new PhoneProxyException("Proxy doesn't exist with $id");
        }

        return $phone;
    }
}
