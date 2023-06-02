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

namespace Evrinoma\CoordinateBundle\DtoCommon\ValueObject\Immutable;

use Evrinoma\CoordinateBundle\Dto\CoordinateApiDtoInterface as BaseCoordinateApiDtoInterface;

interface CoordinateApiDtoInterface
{
    public const COORDINATE = BaseCoordinateApiDtoInterface::COORDINATE;

    public function hasCoordinateApiDto(): bool;

    public function getCoordinateApiDto(): BaseCoordinateApiDtoInterface;
}
