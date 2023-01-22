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
use Symfony\Component\HttpFoundation\Request;

trait PhonesApiDtoTrait
{
    protected array $phonesApiDto = [];

    protected static string $classPhonesApiDto = PhoneApiDto::class;

    public function hasPhonesApiDto(): bool
    {
        return 0 !== \count($this->phonesApiDto);
    }

    public function getPhonesApiDto(): array
    {
        return $this->phonesApiDto;
    }

    public function genRequestPhonesApiDto(?Request $request): ?\Generator
    {
        if ($request) {
            $entities = $request->get(PhonesApiDtoInterface::PHONES);
            if ($entities) {
                foreach ($entities as $entity) {
                    $newRequest = $this->getCloneRequest();
                    $entity[DtoInterface::DTO_CLASS] = static::$classPhonesApiDto;
                    $newRequest->request->add($entity);

                    yield $newRequest;
                }
            }
        }
    }
}
