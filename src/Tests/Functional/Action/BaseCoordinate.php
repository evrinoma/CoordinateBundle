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

namespace Evrinoma\CoordinateBundle\Tests\Functional\Action;

use Evrinoma\CoordinateBundle\Dto\CoordinateApiDto;
use Evrinoma\CoordinateBundle\Dto\CoordinateApiDtoInterface;
use Evrinoma\CoordinateBundle\Tests\Functional\Helper\BaseCoordinateTestTrait;
use Evrinoma\CoordinateBundle\Tests\Functional\ValueObject\Coordinate\Altitude;
use Evrinoma\CoordinateBundle\Tests\Functional\ValueObject\Coordinate\Id;
use Evrinoma\CoordinateBundle\Tests\Functional\ValueObject\Coordinate\Latitude;
use Evrinoma\CoordinateBundle\Tests\Functional\ValueObject\Coordinate\Longitude;
use Evrinoma\TestUtilsBundle\Action\AbstractServiceTest;
use Evrinoma\UtilsBundle\Model\Rest\PayloadModel;
use PHPUnit\Framework\Assert;

class BaseCoordinate extends AbstractServiceTest implements BaseCoordinateTestInterface
{
    use BaseCoordinateTestTrait;

    public const API_GET = 'evrinoma/api/coordinate';
    public const API_CRITERIA = 'evrinoma/api/coordinate/criteria';
    public const API_DELETE = 'evrinoma/api/coordinate/delete';
    public const API_PUT = 'evrinoma/api/coordinate/save';
    public const API_POST = 'evrinoma/api/coordinate/create';

    protected static function getDtoClass(): string
    {
        return CoordinateApiDto::class;
    }

    protected static function defaultData(): array
    {
        return [
            CoordinateApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            CoordinateApiDtoInterface::ID => Id::default(),
            CoordinateApiDtoInterface::LATITUDE => Latitude::value(),
            CoordinateApiDtoInterface::LONGITUDE => Longitude::value(),
            CoordinateApiDtoInterface::ALTITUDE => Altitude::value(),
        ];
    }

    public function actionPost(): void
    {
        $this->createCoordinate();
        $this->testResponseStatusCreated();
    }

    public function actionCriteriaNotFound(): void
    {
        $find = $this->criteria([
            CoordinateApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            CoordinateApiDtoInterface::LATITUDE => Latitude::default(),
        ]);
        $this->testResponseStatusNotFound();
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $find);

        $find = $this->criteria([
            CoordinateApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            CoordinateApiDtoInterface::ID => Id::value(),
            CoordinateApiDtoInterface::LATITUDE => Latitude::default(),
            CoordinateApiDtoInterface::LONGITUDE => Longitude::default(),
        ]);
        $this->testResponseStatusNotFound();
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $find);

        $find = $this->criteria([
            CoordinateApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            CoordinateApiDtoInterface::ID => Id::value(),
            CoordinateApiDtoInterface::LATITUDE => Latitude::default(),
            CoordinateApiDtoInterface::LONGITUDE => Longitude::default(),
            CoordinateApiDtoInterface::ALTITUDE => Altitude::default(),
        ]);
        $this->testResponseStatusNotFound();
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $find);
    }

    public function actionCriteria(): void
    {
        $find = $this->criteria([
            CoordinateApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            CoordinateApiDtoInterface::ID => Id::value(),
        ]);
        $this->testResponseStatusOK();
        Assert::assertCount(1, $find[PayloadModel::PAYLOAD]);

        $find = $this->criteria([
            CoordinateApiDtoInterface::DTO_CLASS => static::getDtoClass(),
            CoordinateApiDtoInterface::LATITUDE => Latitude::value(),
            CoordinateApiDtoInterface::LONGITUDE => Longitude::value(),
            CoordinateApiDtoInterface::ALTITUDE => Altitude::value(),
        ]);
        $this->testResponseStatusOK();
        Assert::assertCount(1, $find[PayloadModel::PAYLOAD]);
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
            CoordinateApiDtoInterface::ID => Id::value(),
            CoordinateApiDtoInterface::LONGITUDE => Longitude::value(),
            CoordinateApiDtoInterface::ALTITUDE => Altitude::value(),
        ]));
        $this->testResponseStatusOK();

        Assert::assertEquals($find[PayloadModel::PAYLOAD][0][CoordinateApiDtoInterface::ID], $updated[PayloadModel::PAYLOAD][0][CoordinateApiDtoInterface::ID]);
        Assert::assertEquals(Longitude::value(), $updated[PayloadModel::PAYLOAD][0][CoordinateApiDtoInterface::LONGITUDE]);
        Assert::assertEquals(Altitude::value(), $updated[PayloadModel::PAYLOAD][0][CoordinateApiDtoInterface::ALTITUDE]);
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
            CoordinateApiDtoInterface::ID => Id::wrong(),
            CoordinateApiDtoInterface::LONGITUDE => Longitude::wrong(),
            CoordinateApiDtoInterface::ALTITUDE => Altitude::wrong(),
        ]));
        $this->testResponseStatusNotFound();
    }

    public function actionPutUnprocessable(): void
    {
        $created = $this->createCoordinate();
        $this->testResponseStatusCreated();
        $this->checkResult($created);

        $query = static::getDefault([
            CoordinateApiDtoInterface::ID => $created[PayloadModel::PAYLOAD][0][CoordinateApiDtoInterface::ID],
            CoordinateApiDtoInterface::LONGITUDE => Longitude::blank(),
        ]);

        $this->put($query);
        $this->testResponseStatusUnprocessable();

        $query = static::getDefault([
            CoordinateApiDtoInterface::ID => $created[PayloadModel::PAYLOAD][0][CoordinateApiDtoInterface::ID],
            CoordinateApiDtoInterface::ALTITUDE => Altitude::blank(),
        ]);

        $this->put($query);
        $this->testResponseStatusUnprocessable();
    }

    public function actionPostDuplicate(): void
    {
        $this->createCoordinate();
        $this->testResponseStatusCreated();
        Assert::markTestIncomplete('This test has not been implemented yet.');
    }

    public function actionPostUnprocessable(): void
    {
        $this->postWrong();
        $this->testResponseStatusUnprocessable();

        $this->createConstraintBlankLatitude();
        $this->testResponseStatusUnprocessable();

        $this->createConstraintBlankLongitude();
        $this->testResponseStatusUnprocessable();

        $this->createConstraintBlankAltitude();
        $this->testResponseStatusUnprocessable();
    }
}
