<?php

declare(strict_types=1);

/*
 * This file is part of the package ITE product.
 *
 * Developer list:
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\CoordinateBundle\Mediator\Common;

use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\CoordinateBundle\DtoCommon\ValueObject\Immutable\CoordinateApiDtoInterface;
use Evrinoma\CoordinateBundle\Repository\AliasInterface as CoordinateAliasInterface;
use Evrinoma\UtilsBundle\QueryBuilder\QueryBuilderInterface;

trait CommonCoordinateMediatorTrait
{
    protected function joinCoordinate(DtoInterface $dto, QueryBuilderInterface $builder, string $alias): void
    {
        $aliasCoordinate = CoordinateAliasInterface::COORDINATE;
        $builder
            ->leftJoin($alias.'.coordinate', $aliasCoordinate)
            ->addSelect($aliasCoordinate);
        /** @var CoordinateApiDtoInterface $dto */
        if ($dto->hasCoordinateApiDto() && $dto->getCoordinateApiDto() && $dto->getCoordinateApiDto()->hasId()) {
            $builder
                ->andWhere($aliasCoordinate.'.id = :idCoordinate')
                ->setParameter('idCoordinate', $dto->getCoordinateApiDto()->getId());
        }
    }

    protected function joinCoordinates(DtoInterface $dto, QueryBuilderInterface $builder, string $alias): void
    {
        $aliasCoordinates = CoordinateAliasInterface::COORDINATES;
        $builder
            ->leftJoin($alias.'.coordinates', $aliasCoordinates)
            ->addSelect($aliasCoordinates);
        /** @var CoordinateApiDtoInterface $dto */
        if ($dto->hasCoordinateApiDto() && $dto->getCoordinateApiDto() && $dto->getCoordinateApiDto()->hasId()) {
            $builder
                ->andWhere($aliasCoordinates.'.id = :idCoordinate')
                ->setParameter('idCoordinate', $dto->getCoordinateApiDto()->getId());
        }
    }
}
