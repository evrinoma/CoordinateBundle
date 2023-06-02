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

namespace Evrinoma\CoordinateBundle\Mediator;

use Evrinoma\CoordinateBundle\Dto\CoordinateApiDtoInterface;
use Evrinoma\CoordinateBundle\Model\Coordinate\CoordinateInterface;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\UtilsBundle\Mediator\AbstractCommandMediator;

class CommandMediator extends AbstractCommandMediator implements CommandMediatorInterface
{
    public function onUpdate(DtoInterface $dto, $entity): CoordinateInterface
    {
        /* @var $dto CoordinateApiDtoInterface */
        $entity
            ->setLongitude($dto->getLongitude())
            ->setLatitude($dto->getLatitude())
            ->setAltitude($dto->getAltitude())
            ->setUpdatedAt(new \DateTimeImmutable());

        return $entity;
    }

    public function onDelete(DtoInterface $dto, $entity): void
    {
    }

    public function onCreate(DtoInterface $dto, $entity): CoordinateInterface
    {
        /* @var $dto CoordinateApiDtoInterface */
        $entity
            ->setLongitude($dto->getLongitude())
            ->setLatitude($dto->getLatitude())
            ->setAltitude($dto->getAltitude())
            ->setCreatedAt(new \DateTimeImmutable());

        return $entity;
    }
}
