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

namespace Evrinoma\PhoneBundle\Tests\Functional\Helper;

use Evrinoma\PhoneBundle\Dto\PhoneApiDtoInterface;
use Evrinoma\UtilsBundle\Model\Rest\PayloadModel;
use PHPUnit\Framework\Assert;

trait BasePhoneTestTrait
{
    protected function assertGet(string $id): array
    {
        $find = $this->get($id);
        $this->testResponseStatusOK();

        $this->checkResult($find);

        return $find;
    }

    protected function createPhone(): array
    {
        $query = static::getDefault();

        return $this->post($query);
    }

    protected function createConstraintBlankNumber(): array
    {
        $query = static::getDefault([PhoneApiDtoInterface::NUMBER => '']);

        return $this->post($query);
    }

    protected function createConstraintBlankCode(): array
    {
        $query = static::getDefault([PhoneApiDtoInterface::CODE => '']);

        return $this->post($query);
    }

    protected function createConstraintBlankCountry(): array
    {
        $query = static::getDefault([PhoneApiDtoInterface::COUNTRY => '']);

        return $this->post($query);
    }

    protected function checkResult($entity): void
    {
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $entity);
        Assert::assertCount(1, $entity[PayloadModel::PAYLOAD]);
        $this->checkPhone($entity[PayloadModel::PAYLOAD][0]);
    }

    protected function checkPhone($entity): void
    {
        Assert::assertArrayHasKey(PhoneApiDtoInterface::ID, $entity);
        Assert::assertArrayHasKey(PhoneApiDtoInterface::DESCRIPTION, $entity);
        Assert::assertArrayHasKey(PhoneApiDtoInterface::NUMBER, $entity);
        Assert::assertArrayHasKey(PhoneApiDtoInterface::CODE, $entity);
        Assert::assertArrayHasKey(PhoneApiDtoInterface::COUNTRY, $entity);
    }
}
