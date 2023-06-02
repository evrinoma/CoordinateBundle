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

namespace Evrinoma\CoordinateBundle\PreValidator;

use Evrinoma\CoordinateBundle\Dto\CoordinateApiDtoInterface;
use Evrinoma\CoordinateBundle\Exception\CoordinateInvalidException;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Evrinoma\UtilsBundle\PreValidator\AbstractPreValidator;

class DtoPreValidator extends AbstractPreValidator implements DtoPreValidatorInterface
{
    public function onPost(DtoInterface $dto): void
    {
        $this
            ->checkLatitude($dto)
            ->checkLongitude($dto)
            ->checkAltitude($dto);
    }

    public function onPut(DtoInterface $dto): void
    {
        $this
            ->checkId($dto)
            ->checkLatitude($dto)
            ->checkLongitude($dto)
            ->checkAltitude($dto);
    }

    public function onDelete(DtoInterface $dto): void
    {
        $this->checkId($dto);
    }

    private function checkLatitude(DtoInterface $dto): self
    {
        /** @var CoordinateApiDtoInterface $dto */
        if (!$dto->hasLatitude()) {
            throw new CoordinateInvalidException('The Dto has\'t latitude');
        }

        return $this;
    }

    private function checkLongitude(DtoInterface $dto): self
    {
        /** @var CoordinateApiDtoInterface $dto */
        if (!$dto->hasLongitude()) {
            throw new CoordinateInvalidException('The Dto has\'t longitude');
        }

        return $this;
    }

    private function checkAltitude(DtoInterface $dto): self
    {
        /** @var CoordinateApiDtoInterface $dto */
        if (!$dto->hasAltitude()) {
            throw new CoordinateInvalidException('The Dto has\'t altitude');
        }

        return $this;
    }

    private function checkId(DtoInterface $dto): self
    {
        /** @var CoordinateApiDtoInterface $dto */
        if (!$dto->hasId()) {
            throw new CoordinateInvalidException('The Dto has\'t ID or class invalid');
        }

        return $this;
    }
}
