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

namespace Evrinoma\CoordinateBundle\Tests\Functional\Helper;

use Evrinoma\CoordinateBundle\Dto\CoordinateApiDtoInterface;
use Evrinoma\UtilsBundle\Model\Rest\PayloadModel;
use PHPUnit\Framework\Assert;

trait BaseCoordinateTestTrait
{
    protected function assertGet(string $id): array
    {
        $find = $this->get($id);
        $this->testResponseStatusOK();

        $this->checkResult($find);

        return $find;
    }

    protected function createCoordinate(): array
    {
        $query = static::getDefault();

        return $this->post($query);
    }

    protected function createConstraintBlankLatitude(): array
    {
        $query = static::getDefault([CoordinateApiDtoInterface::LATITUDE => '']);

        return $this->post($query);
    }

    protected function createConstraintBlankLongitude(): array
    {
        $query = static::getDefault([CoordinateApiDtoInterface::LONGITUDE => '']);

        return $this->post($query);
    }

    protected function createConstraintBlankAltitude(): array
    {
        $query = static::getDefault([CoordinateApiDtoInterface::ALTITUDE => '']);

        return $this->post($query);
    }

    protected function checkResult($entity): void
    {
        Assert::assertArrayHasKey(PayloadModel::PAYLOAD, $entity);
        Assert::assertCount(1, $entity[PayloadModel::PAYLOAD]);
        $this->checkCoordinate($entity[PayloadModel::PAYLOAD][0]);
    }

    protected function checkCoordinate($entity): void
    {
        Assert::assertArrayHasKey(CoordinateApiDtoInterface::ID, $entity);
        Assert::assertArrayHasKey(CoordinateApiDtoInterface::LATITUDE, $entity);
        Assert::assertArrayHasKey(CoordinateApiDtoInterface::LONGITUDE, $entity);
        Assert::assertArrayHasKey(CoordinateApiDtoInterface::ALTITUDE, $entity);
    }
}
