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

namespace Evrinoma\CoordinateBundle\DtoCommon\ValueObject\Mutable;

use Evrinoma\CoordinateBundle\Dto\CoordinateApiDtoInterface;
use Evrinoma\DtoBundle\Dto\DtoInterface;

interface CoordinatesApiDtoInterface
{
    public function addCoordinatesApiDto(CoordinateApiDtoInterface $coordinateApiDto): DtoInterface;
}
