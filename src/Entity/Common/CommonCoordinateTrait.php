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

use Evrinoma\CoordinateBundle\Model\Coordinate\CoordinateInterface as BaseCoordinateInterface;

trait CommonCoordinateTrait
{
    protected BaseCoordinateInterface $coordinate;

    public function getCoordinate(): BaseCoordinateInterface
    {
        return $this->coordinate;
    }

    public function setCoordinate(BaseCoordinateInterface $coordinate): self
    {
        $this->coordinate = $coordinate;

        return $this;
    }

    public function resetCoordinate(): self
    {
        $this->coordinate = null;

        return $this;
    }
}
