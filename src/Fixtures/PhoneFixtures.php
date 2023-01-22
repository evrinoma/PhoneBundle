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

namespace Evrinoma\PhoneBundle\Fixtures;

use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Evrinoma\PhoneBundle\Dto\PhoneApiDtoInterface;
use Evrinoma\PhoneBundle\Entity\Phone\BasePhone;
use Evrinoma\TestUtilsBundle\Fixtures\AbstractFixture;

class PhoneFixtures extends AbstractFixture implements FixtureGroupInterface, OrderedFixtureInterface
{
    protected static array $data = [
        [
            PhoneApiDtoInterface::DESCRIPTION => '3601',
            PhoneApiDtoInterface::NUMBER => '12341224',
            PhoneApiDtoInterface::CODE => '495',
            PhoneApiDtoInterface::COUNTRY => '+7',
            'created_at' => '2008-10-23 10:21:50',
        ],
        [
            PhoneApiDtoInterface::DESCRIPTION => '3602',
            PhoneApiDtoInterface::NUMBER => '12341235',
            PhoneApiDtoInterface::CODE => '496',
            PhoneApiDtoInterface::COUNTRY => '+7',
            'created_at' => '2015-10-23 10:21:50',
        ],
        [
            PhoneApiDtoInterface::DESCRIPTION => '3603',
            PhoneApiDtoInterface::NUMBER => '12341236',
            PhoneApiDtoInterface::CODE => '176',
            PhoneApiDtoInterface::COUNTRY => '+49',
            'created_at' => '2020-10-23 10:21:50',
        ],
        [
            PhoneApiDtoInterface::DESCRIPTION => '3604',
            PhoneApiDtoInterface::NUMBER => '12341237',
            PhoneApiDtoInterface::CODE => '176',
            PhoneApiDtoInterface::COUNTRY => '+34',
            'created_at' => '2020-10-23 10:21:50',
        ],
        [
            PhoneApiDtoInterface::DESCRIPTION => '3605',
            PhoneApiDtoInterface::NUMBER => '12341238',
            PhoneApiDtoInterface::CODE => '176',
            PhoneApiDtoInterface::COUNTRY => '+7',
            'created_at' => '2015-10-23 10:21:50',
            ],
        [
            PhoneApiDtoInterface::DESCRIPTION => '3606',
            PhoneApiDtoInterface::NUMBER => '12341239',
            PhoneApiDtoInterface::CODE => '495',
            PhoneApiDtoInterface::COUNTRY => '+7',
            'created_at' => '2010-10-23 10:21:50',
        ],
        [
            PhoneApiDtoInterface::DESCRIPTION => '3607',
            PhoneApiDtoInterface::NUMBER => '12341230',
            PhoneApiDtoInterface::CODE => '495',
            PhoneApiDtoInterface::COUNTRY => '+7',
            'created_at' => '2010-10-23 10:21:50',
            ],
        [
            PhoneApiDtoInterface::DESCRIPTION => '3608',
            PhoneApiDtoInterface::NUMBER => '12341244',
            PhoneApiDtoInterface::CODE => '495',
            PhoneApiDtoInterface::COUNTRY => '+7',
            'created_at' => '2011-10-23 10:21:50',
        ],
    ];

    protected static string $class = BasePhone::class;

    /**
     * @param ObjectManager $manager
     *
     * @return $this
     *
     * @throws \Exception
     */
    protected function create(ObjectManager $manager): self
    {
        $short = self::getReferenceName();
        $i = 0;

        foreach ($this->getData() as $record) {
            /** @var BasePhone $entity */
            $entity = $this->getEntity();
            $entity
                ->setDescription($record[PhoneApiDtoInterface::DESCRIPTION])
                ->setNumber($record[PhoneApiDtoInterface::NUMBER])
                ->setCode($record[PhoneApiDtoInterface::CODE])
                ->setCountry($record[PhoneApiDtoInterface::COUNTRY])
                ->setCreatedAt(new \DateTimeImmutable($record['created_at']));

            $this->expandEntity($entity, $record);

            $this->addReference($short.$i, $entity);
            $manager->persist($entity);
            ++$i;
        }

        return $this;
    }

    public static function getGroups(): array
    {
        return [
            FixtureInterface::PHONE_FIXTURES,
        ];
    }

    public function getOrder()
    {
        return 0;
    }
}
