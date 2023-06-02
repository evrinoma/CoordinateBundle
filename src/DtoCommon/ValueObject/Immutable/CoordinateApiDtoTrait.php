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
use Evrinoma\CoordinateBundle\Dto\CoordinateApiDtoInterface as BaseCoordinateApiDtoInterface;
use Evrinoma\DtoBundle\Dto\DtoInterface;
use Symfony\Component\HttpFoundation\Request;

trait CoordinateApiDtoTrait
{
    protected ?BaseCoordinateApiDtoInterface $phoneApiDto = null;

    protected static string $classCoordinateApiDto = CoordinateApiDto::class;

    public function genRequestCoordinateApiDto(?Request $request): ?\Generator
    {
        if ($request) {
            $phone = $request->get(CoordinateApiDtoInterface::COORDINATE);
            if ($phone) {
                $newRequest = $this->getCloneRequest();
                $phone[DtoInterface::DTO_CLASS] = static::$classCoordinateApiDto;
                $newRequest->request->add($phone);

                yield $newRequest;
            }
        }
    }

    public function hasCoordinateApiDto(): bool
    {
        return null !== $this->phoneApiDto;
    }

    public function getCoordinateApiDto(): BaseCoordinateApiDtoInterface
    {
        return $this->phoneApiDto;
    }
}