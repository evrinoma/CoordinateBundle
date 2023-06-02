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

use Evrinoma\CoordinateBundle\DtoCommon\ValueObject\Mutable\AltitudeTrait;
use Evrinoma\CoordinateBundle\DtoCommon\ValueObject\Mutable\LatitudeTrait;
use Evrinoma\CoordinateBundle\DtoCommon\ValueObject\Mutable\LongitudeTrait;
use Evrinoma\DtoBundle\Dto\AbstractDto;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\DtoCommon\ValueObject\Mutable\IdTrait;
use Symfony\Component\HttpFoundation\Request;

class CoordinateApiDto extends AbstractDto implements CoordinateApiDtoInterface
{
    use AltitudeTrait;
    use IdTrait;
    use LatitudeTrait;
    use LongitudeTrait;

    public function toDto(Request $request): DtoInterface
    {
        $class = $request->get(DtoInterface::DTO_CLASS);

        if ($class === $this->getClass()) {
            $id = $request->get(CoordinateApiDtoInterface::ID);
            $longitude = $request->get(CoordinateApiDtoInterface::LONGITUDE);
            $latitude = $request->get(CoordinateApiDtoInterface::LATITUDE);
            $altitude = $request->get(CoordinateApiDtoInterface::ALTITUDE);

            if ($id) {
                $this->setId($id);
            }
            if ($longitude) {
                $this->setLongitude($longitude);
            }
            if ($latitude) {
                $this->setLatitude($latitude);
            }
            if ($altitude) {
                $this->setAltitude($altitude);
            }
        }

        return $this;
    }
}
