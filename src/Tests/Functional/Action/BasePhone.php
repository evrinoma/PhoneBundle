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

namespace Evrinoma\PhoneBundle\Tests\Functional\Action;

use Evrinoma\PhoneBundle\Dto\PhoneApiDto;
use Evrinoma\PhoneBundle\Dto\PhoneApiDtoInterface;
use Evrinoma\PhoneBundle\Tests\Functional\Helper\BasePhoneTestTrait;
use Evrinoma\PhoneBundle\Tests\Functional\ValueObject\Phone\Code;
use Evrinoma\PhoneBundle\Tests\Functional\ValueObject\Phone\Country;
use Evrinoma\PhoneBundle\Tests\Functional\ValueObject\Phone\Description;
use Evrinoma\PhoneBundle\Tests\Functional\ValueObject\Phone\Id;
use Evrinoma\PhoneBundle\Tests\Functional\ValueObject\Phone\Number;
use Evrinoma\TestUtilsBundle\Action\AbstractServiceTest;
use Evrinoma\UtilsBundle\Model\Rest\PayloadModel;
use PHPUnit\Framework\Assert;

class BasePhone extends AbstractServiceTest implements BasePhoneTestInterface
{
    use BasePhoneTestTrait;

    public const API_GET = 'evrinoma/api/phone';
    public const API_CRITERIA = 'evrinoma/api/phone/criteria';
    public const API_DELETE = 'evrinoma/api/phone/delete';
    public const API_PUT = 'evrinoma/api/phone/save';
    public const API_POST = 'evrinoma/api/phone/create';

    protected static function getDtoClass(): string
    {
        return PhoneApiDto::class;
    }

    protected static function defaultData(): array
    {
        return [
            PhoneApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            PhoneApiDtoInterface::ID => Id::value(),
            PhoneApiDtoInterface::DESCRIPTION => Description::default(),
            PhoneApiDtoInterface::NUMBER => Number::value(),
            PhoneApiDtoInterface::CODE => Code::value(),
            PhoneApiDtoInterface::COUNTRY => Country::value(),
        ];
    }

    public function actionPost(): void
    {
        $created = $this->createPhone();
        $this->testResponseStatusCreated();
    }

    public function actionCriteriaNotFound(): void
    {
        $find = $this->criteria([
            PhoneApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            PhoneApiDtoInterface::ID => Id::wrong(),
        ]);
        $this->testResponseStatusNotFound();
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $find);

        $find = $this->criteria([
            PhoneApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            PhoneApiDtoInterface::ID => Id::value(),
            PhoneApiDtoInterface::DESCRIPTION => Description::wrong(),
        ]);
        $this->testResponseStatusNotFound();
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $find);
    }

    public function actionCriteria(): void
    {
        $find = $this->criteria([
            PhoneApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            PhoneApiDtoInterface::ID => Id::value(),
        ]);
        $this->testResponseStatusOK();
        Assert::assertCount(1, $find[PayloadModel::PAYLOAD]);

        $find = $this->criteria([
            PhoneApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            PhoneApiDtoInterface::DESCRIPTION => Description::value(),
        ]);
        $this->testResponseStatusOK();
        Assert::assertCount(1, $find[PayloadModel::PAYLOAD]);

        $find = $this->criteria([
            PhoneApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            PhoneApiDtoInterface::COUNTRY => Country::value(),
            PhoneApiDtoInterface::CODE => Code::value(),
        ]);
        $this->testResponseStatusOK();
        Assert::assertCount(4, $find[PayloadModel::PAYLOAD]);
    }

    public function actionDelete(): void
    {
        $find = $this->assertGet(Id::value());

        $this->delete(Id::value());
        $this->testResponseStatusAccepted();

        $delete = $this->get(Id::value());
        $this->testResponseStatusNotFound();
    }

    public function actionPut(): void
    {
        $find = $this->assertGet(Id::value());

        $updated = $this->put(static::getDefault([
            PhoneApiDtoInterface::ID => Id::value(),
            PhoneApiDtoInterface::DESCRIPTION => Description::value(),
            PhoneApiDtoInterface::NUMBER => Number::value(),
            PhoneApiDtoInterface::CODE => Code::value(),
            PhoneApiDtoInterface::COUNTRY => Country::value(),
        ]));
        $this->testResponseStatusOK();

        Assert::assertEquals($find[PayloadModel::PAYLOAD][0][PhoneApiDtoInterface::ID], $updated[PayloadModel::PAYLOAD][0][PhoneApiDtoInterface::ID]);
        Assert::assertEquals(Description::value(), $updated[PayloadModel::PAYLOAD][0][PhoneApiDtoInterface::DESCRIPTION]);
        Assert::assertEquals(Number::value(), $updated[PayloadModel::PAYLOAD][0][PhoneApiDtoInterface::NUMBER]);
        Assert::assertEquals(Country::value(), $updated[PayloadModel::PAYLOAD][0][PhoneApiDtoInterface::COUNTRY]);
        Assert::assertEquals(Code::value(), $updated[PayloadModel::PAYLOAD][0][PhoneApiDtoInterface::CODE]);
    }

    public function actionGet(): void
    {
        $find = $this->assertGet(Id::value());
    }

    public function actionGetNotFound(): void
    {
        $response = $this->get(Id::wrong());
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $response);
        $this->testResponseStatusNotFound();
    }

    public function actionDeleteNotFound(): void
    {
        $response = $this->delete(Id::wrong());
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $response);
        $this->testResponseStatusNotFound();
    }

    public function actionDeleteUnprocessable(): void
    {
        $response = $this->delete(Id::blank());
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $response);
        $this->testResponseStatusUnprocessable();
    }

    public function actionPutNotFound(): void
    {
        $this->put(static::getDefault([
            PhoneApiDtoInterface::ID => Id::wrong(),
            PhoneApiDtoInterface::DESCRIPTION => Description::wrong(),
            PhoneApiDtoInterface::NUMBER => Number::wrong(),
            PhoneApiDtoInterface::COUNTRY => Country::wrong(),
            PhoneApiDtoInterface::CODE => Code::wrong(),
        ]));
        $this->testResponseStatusNotFound();
    }

    public function actionPutUnprocessable(): void
    {
        $created = $this->createPhone();
        $this->testResponseStatusCreated();
        $this->checkResult($created);

        $query = static::getDefault([
            PhoneApiDtoInterface::ID => $created[PayloadModel::PAYLOAD][0][PhoneApiDtoInterface::ID],
            PhoneApiDtoInterface::NUMBER => Number::blank(),
        ]);

        $this->put($query);
        $this->testResponseStatusUnprocessable();

        $query = static::getDefault([
            PhoneApiDtoInterface::ID => $created[PayloadModel::PAYLOAD][0][PhoneApiDtoInterface::ID],
            PhoneApiDtoInterface::CODE => Code::blank(),
        ]);

        $this->put($query);
        $this->testResponseStatusUnprocessable();

        $query = static::getDefault([
            PhoneApiDtoInterface::ID => $created[PayloadModel::PAYLOAD][0][PhoneApiDtoInterface::ID],
            PhoneApiDtoInterface::COUNTRY => Country::blank(),
        ]);

        $this->put($query);
        $this->testResponseStatusUnprocessable();

        $query = static::getDefault([
            PhoneApiDtoInterface::ID => $created[PayloadModel::PAYLOAD][0][PhoneApiDtoInterface::ID],
            PhoneApiDtoInterface::DESCRIPTION => Description::blank(),
        ]);

        $this->put($query);
        $this->testResponseStatusUnprocessable();
    }

    public function actionPostDuplicate(): void
    {
        $this->createPhone();
        $this->testResponseStatusCreated();
        $this->createPhone();
        $this->testResponseStatusConflict();
    }

    public function actionPostUnprocessable(): void
    {
        $this->postWrong();
        $this->testResponseStatusUnprocessable();

        $this->createConstraintBlankNumber();
        $this->testResponseStatusUnprocessable();

        $this->createConstraintBlankCountry();
        $this->testResponseStatusUnprocessable();

        $this->createConstraintBlankCode();
        $this->testResponseStatusUnprocessable();
    }
}
