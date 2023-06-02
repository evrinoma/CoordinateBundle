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

namespace Evrinoma\CoordinateBundle\Model\Coordinate;

use Doctrine\ORM\Mapping as ORM;
use Evrinoma\UtilsBundle\Entity\CreateUpdateAtTrait;
use Evrinoma\UtilsBundle\Entity\IdTrait;

/**
 * @ORM\MappedSuperclass
 */
abstract class AbstractCoordinate implements CoordinateInterface
{
    use CreateUpdateAtTrait;
    use IdTrait;

    /**
     * @ORM\Column(name="latitude", type="decimal", precision=20, scale=16, nullable=false)
     */
    protected $latitude;

    /**
     * @ORM\Column(name="longitude", type="decimal", precision=20, scale=16, nullable=false)
     */
    protected $longitude;

    /**
     * @ORM\Column(name="altitude", type="decimal", precision=20, scale=16, nullable=false)
     */
    protected $altitude;

    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param $latitude
     * @return self
     */
    public function setLatitude($latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param $longitude
     * @return self
     */
    public function setLongitude($longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getAltitude()
    {
        return $this->altitude;
    }

    /**
     * @param $altitude
     * @return self
     */
    public function setAltitude($altitude): self
    {
        $this->altitude = $altitude;

        return $this;
    }
}
