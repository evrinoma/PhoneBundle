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

use Evrinoma\PhoneBundle\Exception\PhoneCannotBeRemovedException;
use Evrinoma\PhoneBundle\Exception\PhoneCannotBeSavedException;
use Evrinoma\PhoneBundle\Model\Phone\PhoneInterface;

interface PhoneCommandRepositoryInterface
{
    /**
     * @param PhoneInterface $phone
     *
     * @return bool
     *
     * @throws PhoneCannotBeSavedException
     */
    public function save(PhoneInterface $phone): bool;

    /**
     * @param PhoneInterface $phone
     *
     * @return bool
     *
     * @throws PhoneCannotBeRemovedException
     */
    public function remove(PhoneInterface $phone): bool;
}
