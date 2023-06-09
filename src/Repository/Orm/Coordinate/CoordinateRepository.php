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

namespace Evrinoma\CoordinateBundle\Repository\Orm\Coordinate;

use Doctrine\Persistence\ManagerRegistry;
use Evrinoma\CoordinateBundle\Mediator\QueryMediatorInterface;
use Evrinoma\CoordinateBundle\Repository\Coordinate\CoordinateRepositoryInterface;
use Evrinoma\CoordinateBundle\Repository\Coordinate\CoordinateRepositoryTrait;
use Evrinoma\UtilsBundle\Repository\Orm\RepositoryWrapper;
use Evrinoma\UtilsBundle\Repository\RepositoryWrapperInterface;

class CoordinateRepository extends RepositoryWrapper implements CoordinateRepositoryInterface, RepositoryWrapperInterface
{
    use CoordinateRepositoryTrait;

    /**
     * @param ManagerRegistry        $registry
     * @param string                 $entityClass
     * @param QueryMediatorInterface $mediator
     */
    public function __construct(ManagerRegistry $registry, string $entityClass, QueryMediatorInterface $mediator)
    {
        parent::__construct($registry, $entityClass);
        $this->mediator = $mediator;
    }
}
