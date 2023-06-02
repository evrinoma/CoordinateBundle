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

namespace Evrinoma\CoordinateBundle\Mediator\Orm;

use Evrinoma\CoordinateBundle\Dto\CoordinateApiDtoInterface;
use Evrinoma\CoordinateBundle\Mediator\QueryMediatorInterface;
use Evrinoma\CoordinateBundle\Repository\AliasInterface;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\UtilsBundle\Mediator\AbstractQueryMediator;
use Evrinoma\UtilsBundle\Mediator\Orm\QueryMediatorTrait;
use Evrinoma\UtilsBundle\QueryBuilder\QueryBuilderInterface;

class QueryMediator extends AbstractQueryMediator implements QueryMediatorInterface
{
    use QueryMediatorTrait;

    protected static string $alias = AliasInterface::COORDINATE;

    /**
     * @param DtoInterface          $dto
     * @param QueryBuilderInterface $builder
     *
     * @return mixed
     */
    public function createQuery(DtoInterface $dto, QueryBuilderInterface $builder): void
    {
        $alias = $this->alias();

        /** @var $dto CoordinateApiDtoInterface */
        if ($dto->hasId()) {
            $builder
                ->andWhere($alias.'.id = :id')
                ->setParameter('id', $dto->getId());
        }
        if ($dto->hasLongitude()) {
            $builder
                ->andWhere($alias.'.longitude = :longitude')
                ->setParameter('longitude', $dto->getLongitude());
        }
        if ($dto->hasLatitude()) {
            $builder
                ->andWhere($alias.'.latitude = :latitude')
                ->setParameter('latitude', $dto->getLatitude());
        }
        if ($dto->hasAltitude()) {
            $builder
                ->andWhere($alias.'.altitude = :altitude')
                ->setParameter('altitude', $dto->getAltitude());
        }
    }
}
