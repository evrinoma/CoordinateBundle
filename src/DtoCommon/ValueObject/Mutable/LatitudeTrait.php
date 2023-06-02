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

use Evrinoma\CoordinateBundle\DtoCommon\ValueObject\Immutable\LatitudeTrait as LatitudeImmutableTrait;
use Evrinoma\DtoBundle\Dto\DtoInterface;

trait LatitudeTrait
{
    use LatitudeImmutableTrait;

    protected function setLatitude(string $latitude): DtoInterface
    {
        if (\is_float($latitude)) {
            $this->latitudeParseDouble($latitude);
        } else {
            $this->latitudeParseString($latitude);
        }

        return $this;
    }

    /**
     * @param string|null $latitude
     *
     * @return DtoInterface
     */
    protected function latitudeParseString(?string $latitude): DtoInterface
    {
        $this->latitude = (float) $latitude;

        return $this;
    }

    /**
     * @param float|null $latitude
     *
     * @return DtoInterface
     */
    protected function latitudeParseDouble(?float $latitude): DtoInterface
    {
        $this->latitude = $latitude;

        return $this;
    }
}
