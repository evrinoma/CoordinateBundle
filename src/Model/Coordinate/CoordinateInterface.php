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

use Evrinoma\UtilsBundle\Entity\CreateUpdateAtInterface;
use Evrinoma\UtilsBundle\Entity\IdInterface;

interface CoordinateInterface extends CreateUpdateAtInterface, IdInterface
{
    public function getLatitude();

    /**
     * @param $latitude
     *
     * @return self
     */
    public function setLatitude($latitude): self;

    public function getLongitude();

    /**
     * @param $longitude
     *
     * @return self
     */
    public function setLongitude($longitude): self;

    public function getAltitude();

    /**
     * @param $altitude
     *
     * @return self
     */
    public function setAltitude($altitude): self;
}
