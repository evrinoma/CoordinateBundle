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

namespace Evrinoma\CoordinateBundle\Dto;

use Evrinoma\CoordinateBundle\DtoCommon\ValueObject\Immutable\AltitudeInterface;
use Evrinoma\CoordinateBundle\DtoCommon\ValueObject\Immutable\LatitudeInterface;
use Evrinoma\CoordinateBundle\DtoCommon\ValueObject\Immutable\LongitudeInterface;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\Immutable\IdInterface;

interface CoordinateApiDtoInterface extends DtoInterface, IdInterface, AltitudeInterface, LongitudeInterface, LatitudeInterface
{
    public const COORDINATE = 'coordinate';
    public const COORDINATES = CoordinateApiDtoInterface::COORDINATE.'s';
}
