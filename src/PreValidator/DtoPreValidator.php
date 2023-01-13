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

namespace Evrinoma\PhoneBundle\PreValidator;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\PhoneBundle\Dto\PhoneApiDtoInterface;
use Evrinoma\PhoneBundle\Exception\PhoneInvalidException;
use Evrinoma\UtilsBundle\PreValidator\AbstractPreValidator;

class DtoPreValidator extends AbstractPreValidator implements DtoPreValidatorInterface
{
    public function onPost(DtoInterface $dto): void
    {
        $this
            ->checkNumber($dto)
            ->checkCode($dto)
            ->checkCountry($dto)
            ->checkDescription($dto)
        ;
    }

    public function onPut(DtoInterface $dto): void
    {
        $this
            ->checkId($dto)
            ->checkNumber($dto)
            ->checkCode($dto)
            ->checkDescription($dto)
            ->checkCountry($dto)
        ;
    }

    public function onDelete(DtoInterface $dto): void
    {
        $this->checkId($dto);
    }

    private function checkCountry(DtoInterface $dto): self
    {
        /** @var PhoneApiDtoInterface $dto */
        if (!$dto->hasCountry()) {
            throw new PhoneInvalidException('The Dto has\'t country');
        }

        return $this;
    }

    private function checkNumber(DtoInterface $dto): self
    {
        /** @var PhoneApiDtoInterface $dto */
        if (!$dto->hasNumber()) {
            throw new PhoneInvalidException('The Dto has\'t number');
        }

        return $this;
    }

    private function checkCode(DtoInterface $dto): self
    {
        /** @var PhoneApiDtoInterface $dto */
        if (!$dto->hasCode()) {
            throw new PhoneInvalidException('The Dto has\'t country code');
        }

        return $this;
    }

    private function checkDescription(DtoInterface $dto): self
    {
        /** @var PhoneApiDtoInterface $dto */
        if (!$dto->hasDescription()) {
            throw new PhoneInvalidException('The Dto has\'t description');
        }

        return $this;
    }

    private function checkId(DtoInterface $dto): self
    {
        /** @var PhoneApiDtoInterface $dto */
        if (!$dto->hasId()) {
            throw new PhoneInvalidException('The Dto has\'t ID or class invalid');
        }

        return $this;
    }
}
