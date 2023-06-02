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

namespace Evrinoma\CoordinateBundle\Dto\Preserve;

use Evrinoma\CoordinateBundle\DtoCommon\ValueObject\Mutable\AltitudeInterface;
use Evrinoma\CoordinateBundle\DtoCommon\ValueObject\Mutable\LatitudeInterface;
use Evrinoma\CoordinateBundle\DtoCommon\ValueObject\Mutable\LongitudeInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\IdInterface;

interface CoordinateApiDtoInterface extends IdInterface, AltitudeInterface, LongitudeInterface, LatitudeInterface
{
}
