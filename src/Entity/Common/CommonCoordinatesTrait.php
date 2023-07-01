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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Evrinoma\CoordinateBundle\Model\Coordinate\CoordinateInterface as BaseCoordinateInterface;

trait CommonCoordinatesTrait
{
    protected Collection $coordinates;

    public function initCoordinates()
    {
        $this->coordinates = new ArrayCollection();
    }

    public function getCoordinates(): Collection
    {
        return $this->coordinates;
    }

    public function addCoordinate(BaseCoordinateInterface $coordinate): self
    {
        $this->coordinates->add($coordinate);

        return $this;
    }

    public function removeCoordinate(BaseCoordinateInterface $coordinate): self
    {
        $this->coordinates->removeElement($coordinate);

        return $this;
    }

    public function clearCoordinate(): self
    {
        $this->coordinates->clear();

        return $this;
    }
}
