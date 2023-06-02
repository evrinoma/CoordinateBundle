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

interface AltitudeInterface
{
    public const ALTITUDE = 'altitude';

    /**
     * @return bool
     */
    public function hasAltitude(): bool;

    /**
     * @return float
     */
    public function getAltitude(): float;
}
