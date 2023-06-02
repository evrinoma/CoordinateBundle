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

interface LongitudeInterface
{
    public const LONGITUDE = 'longitude';

    /**
     * @return bool
     */
    public function hasLongitude(): bool;

    /**
     * @return float
     */
    public function getLongitude(): float;
}
