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

namespace Evrinoma\PhoneBundle\DtoCommon\ValueObject\Immutable;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\PhoneBundle\Dto\PhoneApiDto;
use Evrinoma\PhoneBundle\Dto\PhoneApiDtoInterface as BasePhoneApiDtoInterface;
use Symfony\Component\HttpFoundation\Request;

trait PhoneApiDtoTrait
{
    protected ?BasePhoneApiDtoInterface $phoneApiDto = null;

    protected static string $classPhoneApiDto = PhoneApiDto::class;

    public function genRequestPhoneApiDto(?Request $request): ?\Generator
    {
        if ($request) {
            $phone = $request->get(PhoneApiDtoInterface::PHONE);
            if ($phone) {
                $newRequest = $this->getCloneRequest();
                $phone[DtoInterface::DTO_CLASS] = static::$classPhoneApiDto;
                $newRequest->request->add($phone);

                yield $newRequest;
            }
        }
    }

    public function hasPhoneApiDto(): bool
    {
        return null !== $this->phoneApiDto;
    }

    public function getPhoneApiDto(): BasePhoneApiDtoInterface
    {
        return $this->phoneApiDto;
    }
}
