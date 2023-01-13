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
use Evrinoma\PhoneBundle\Exception\PhoneCannotBeRemovedException;
use Evrinoma\PhoneBundle\Exception\PhoneInvalidException;
use Evrinoma\PhoneBundle\Exception\PhoneNotFoundException;
use Evrinoma\PhoneBundle\Model\Phone\PhoneInterface;

interface CommandManagerInterface
{
    /**
     * @param PhoneApiDtoInterface $dto
     *
     * @return PhoneInterface
     *
     * @throws PhoneInvalidException
     */
    public function post(PhoneApiDtoInterface $dto): PhoneInterface;

    /**
     * @param PhoneApiDtoInterface $dto
     *
     * @return PhoneInterface
     *
     * @throws PhoneInvalidException
     * @throws PhoneNotFoundException
     */
    public function put(PhoneApiDtoInterface $dto): PhoneInterface;

    /**
     * @param PhoneApiDtoInterface $dto
     *
     * @throws PhoneCannotBeRemovedException
     * @throws PhoneNotFoundException
     */
    public function delete(PhoneApiDtoInterface $dto): void;
}
