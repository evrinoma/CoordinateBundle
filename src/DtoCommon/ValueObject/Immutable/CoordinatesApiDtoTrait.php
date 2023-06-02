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

use Evrinoma\CoordinateBundle\Dto\CoordinateApiDto;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Symfony\Component\HttpFoundation\Request;

trait CoordinatesApiDtoTrait
{
    protected array $phonesApiDto = [];

    protected static string $classCoordinatesApiDto = CoordinateApiDto::class;

    public function hasCoordinatesApiDto(): bool
    {
        return 0 !== \count($this->phonesApiDto);
    }

    public function getCoordinatesApiDto(): array
    {
        return $this->phonesApiDto;
    }

    public function genRequestCoordinatesApiDto(?Request $request): ?\Generator
    {
        if ($request) {
            $entities = $request->get(CoordinatesApiDtoInterface::COORDINATES);
            if ($entities) {
                foreach ($entities as $entity) {
                    $newRequest = $this->getCloneRequest();
                    $entity[DtoInterface::DTO_CLASS] = static::$classCoordinatesApiDto;
                    $newRequest->request->add($entity);

                    yield $newRequest;
                }
            }
        }
    }
}
