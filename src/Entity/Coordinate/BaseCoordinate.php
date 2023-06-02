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

namespace Evrinoma\CoordinateBundle\Entity\Coordinate;

use Doctrine\ORM\Mapping as ORM;
use Evrinoma\CoordinateBundle\Model\Coordinate\AbstractCoordinate;

/**
 * @ORM\Table(name="e_coordinate")
 *
 * @ORM\Entity
 */
class BaseCoordinate extends AbstractCoordinate
{
}
