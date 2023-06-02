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

namespace Evrinoma\CoordinateBundle\Factory\Coordinate;

use Evrinoma\CoordinateBundle\Dto\CoordinateApiDtoInterface;
use Evrinoma\CoordinateBundle\Model\Coordinate\CoordinateInterface;

interface FactoryInterface
{
    /**
     * @param CoordinateApiDtoInterface $dto
     *
     * @return CoordinateInterface
     */
    public function create(CoordinateApiDtoInterface $dto): CoordinateInterface;
}
