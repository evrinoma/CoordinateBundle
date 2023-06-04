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

namespace Evrinoma\CoordinateBundle\Entity\Common;

use Doctrine\Common\Collections\Collection;
use Evrinoma\CoordinateBundle\Model\Coordinate\CoordinateInterface as BaseCoordinateInterface;

interface CommonCoordinatesInterface
{
    public function getCoordinates(): Collection;

    public function addCoordinate(BaseCoordinateInterface $coordinate): self;

    public function removeCoordinate(BaseCoordinateInterface $coordinate): self;

    public function clearCoordinate(): self;
}
