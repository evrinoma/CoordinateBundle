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

use Evrinoma\CoordinateBundle\DtoCommon\ValueObject\Immutable\AltitudeTrait as AltitudeImmutableTrait;
use Evrinoma\DtoBundle\Dto\DtoInterface;

trait AltitudeTrait
{
    use AltitudeImmutableTrait;

    protected function setAltitude(string $altitude): DtoInterface
    {
        if (\is_float($altitude)) {
            $this->altitudeParseDouble($altitude);
        } else {
            $this->altitudeParseString($altitude);
        }

        return $this;
    }

    /**
     * @param string|null $altitude
     *
     * @return DtoInterface
     */
    protected function altitudeParseString(?string $altitude): DtoInterface
    {
        $this->altitude = (float) $altitude;

        return $this;
    }

    /**
     * @param float|null $altitude
     *
     * @return DtoInterface
     */
    protected function altitudeParseDouble(?float $altitude): DtoInterface
    {
        $this->altitude = $altitude;

        return $this;
    }
}
