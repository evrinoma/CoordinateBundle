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

use Evrinoma\CoordinateBundle\Exception\CoordinateCannotBeRemovedException;
use Evrinoma\CoordinateBundle\Exception\CoordinateCannotBeSavedException;
use Evrinoma\CoordinateBundle\Model\Coordinate\CoordinateInterface;

interface CoordinateCommandRepositoryInterface
{
    /**
     * @param CoordinateInterface $coordinate
     *
     * @return bool
     *
     * @throws CoordinateCannotBeSavedException
     */
    public function save(CoordinateInterface $coordinate): bool;

    /**
     * @param CoordinateInterface $coordinate
     *
     * @return bool
     *
     * @throws CoordinateCannotBeRemovedException
     */
    public function remove(CoordinateInterface $coordinate): bool;
}
