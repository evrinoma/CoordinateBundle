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

interface LatitudeInterface
{
    public const LATITUDE = 'latitude';

    /**
     * @return bool
     */
    public function hasLatitude(): bool;

    /**
     * @return float
     */
    public function getLatitude(): float;
}
