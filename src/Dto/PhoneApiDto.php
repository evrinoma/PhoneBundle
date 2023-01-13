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

namespace Evrinoma\PhoneBundle\Dto;

use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\DescriptionTrait;
use Evrinoma\DtoCommon\ValueObject\Mutable\IdTrait;
use Evrinoma\PhoneBundle\DtoCommon\ValueObject\Mutable\CodeTrait;
use Evrinoma\PhoneBundle\DtoCommon\ValueObject\Mutable\CountryTrait;
use Evrinoma\PhoneBundle\DtoCommon\ValueObject\Mutable\NumberTrait;
use Symfony\Component\HttpFoundation\Request;

class PhoneApiDto extends AbstractDto implements PhoneApiDtoInterface
{
    use CodeTrait;
    use CountryTrait;
    use DescriptionTrait;
    use IdTrait;
    use NumberTrait;

    public function toDto(Request $request): DtoInterface
    {
        $class = $request->get(DtoInterface::DTO_CLASS);

        if ($class === $this->getClass()) {
            $id = $request->get(PhoneApiDtoInterface::ID);
            $number = $request->get(PhoneApiDtoInterface::NUMBER);
            $code = $request->get(PhoneApiDtoInterface::CODE);
            $description = $request->get(PhoneApiDtoInterface::DESCRIPTION);
            $country = $request->get(PhoneApiDtoInterface::COUNTRY);

            if ($id) {
                $this->setId($id);
            }
            if ($number) {
                $this->setNumber($number);
            }
            if ($code) {
                $this->setCode($code);
            }
            if ($country) {
                $this->setCountry($country);
            }
            if ($description) {
                $this->setDescription($description);
            }
        }

        return $this;
    }
}
