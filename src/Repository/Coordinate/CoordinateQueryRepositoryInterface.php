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

namespace Evrinoma\CoordinateBundle\Repository\Coordinate;

use Doctrine\ORM\Exception\ORMException;
use Evrinoma\CoordinateBundle\Dto\CoordinateApiDtoInterface;
use Evrinoma\CoordinateBundle\Exception\CoordinateNotFoundException;
use Evrinoma\CoordinateBundle\Exception\CoordinateProxyException;
use Evrinoma\CoordinateBundle\Model\Coordinate\CoordinateInterface;

interface CoordinateQueryRepositoryInterface
{
    /**
     * @param CoordinateApiDtoInterface $dto
     *
     * @return array
     *
     * @throws CoordinateNotFoundException
     */
    public function findByCriteria(CoordinateApiDtoInterface $dto): array;

    /**
     * @param string $id
     * @param null   $lockMode
     * @param null   $lockVersion
     *
     * @return CoordinateInterface
     *
     * @throws CoordinateNotFoundException
     */
    public function find(string $id, $lockMode = null, $lockVersion = null): CoordinateInterface;

    /**
     * @param string $id
     *
     * @return CoordinateInterface
     *
     * @throws CoordinateProxyException
     * @throws ORMException
     */
    public function proxy(string $id): CoordinateInterface;
}
