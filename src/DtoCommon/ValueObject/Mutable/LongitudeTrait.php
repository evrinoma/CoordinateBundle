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

use Evrinoma\CoordinateBundle\DtoCommon\ValueObject\Immutable\LongitudeTrait as LongitudeImmutableTrait;
use Evrinoma\DtoBundle\Dto\DtoInterface;

trait LongitudeTrait
{
    use LongitudeImmutableTrait;

    protected function setLongitude(string $longitude): DtoInterface
    {
        if (\is_float($longitude)) {
            $this->longitudeParseDouble($longitude);
        } else {
            $this->longitudeParseString($longitude);
        }

        return $this;
    }

    /**
     * @param string|null $longitude
     *
     * @return DtoInterface
     */
    protected function longitudeParseString(?string $longitude): DtoInterface
    {
        $this->longitude = (float) $longitude;

        return $this;
    }

    /**
     * @param float|null $longitude
     *
     * @return DtoInterface
     */
    protected function longitudeParseDouble(?float $longitude): DtoInterface
    {
        $this->longitude = $longitude;

        return $this;
    }
}
