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

namespace Evrinoma\PhoneBundle\Model\Phone;

use Doctrine\ORM\Mapping as ORM;
use Evrinoma\UtilsBundle\Entity\CreateUpdateAtTrait;
use Evrinoma\UtilsBundle\Entity\DescriptionTrait;
use Evrinoma\UtilsBundle\Entity\IdTrait;

/**
 * @ORM\MappedSuperclass
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="idx_phone", columns={"country", "code", "number", "description"})})
 */
abstract class AbstractPhone implements PhoneInterface
{
    use CreateUpdateAtTrait;
    use DescriptionTrait;
    use IdTrait;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=127, nullable=true)
     */
    protected $description;
    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=31, nullable=false)
     */
    protected $country;
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=31, nullable=false)
     */
    protected $code;
    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=127, nullable=false)
     */
    protected $number;

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): PhoneInterface
    {
        $this->country = $country;

        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): PhoneInterface
    {
        $this->code = $code;

        return $this;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): PhoneInterface
    {
        $this->number = $number;

        return $this;
    }
}
