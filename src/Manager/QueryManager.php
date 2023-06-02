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

namespace Evrinoma\CoordinateBundle\Manager;

use Evrinoma\CoordinateBundle\Dto\CoordinateApiDtoInterface;
use Evrinoma\CoordinateBundle\Exception\CoordinateNotFoundException;
use Evrinoma\CoordinateBundle\Exception\CoordinateProxyException;
use Evrinoma\CoordinateBundle\Model\Coordinate\CoordinateInterface;
use Evrinoma\CoordinateBundle\Repository\Coordinate\CoordinateQueryRepositoryInterface;

final class QueryManager implements QueryManagerInterface
{
    private CoordinateQueryRepositoryInterface $repository;

    public function __construct(CoordinateQueryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CoordinateApiDtoInterface $dto
     *
     * @return array
     *
     * @throws CoordinateNotFoundException
     */
    public function criteria(CoordinateApiDtoInterface $dto): array
    {
        try {
            $coordinate = $this->repository->findByCriteria($dto);
        } catch (CoordinateNotFoundException $e) {
            throw $e;
        }

        return $coordinate;
    }

    /**
     * @param CoordinateApiDtoInterface $dto
     *
     * @return CoordinateInterface
     *
     * @throws CoordinateProxyException
     */
    public function proxy(CoordinateApiDtoInterface $dto): CoordinateInterface
    {
        try {
            if ($dto->hasId()) {
                $coordinate = $this->repository->proxy($dto->idToString());
            } else {
                throw new CoordinateProxyException('Id value is not set while trying get proxy object');
            }
        } catch (CoordinateProxyException $e) {
            throw $e;
        }

        return $coordinate;
    }

    /**
     * @param CoordinateApiDtoInterface $dto
     *
     * @return CoordinateInterface
     *
     * @throws CoordinateNotFoundException
     */
    public function get(CoordinateApiDtoInterface $dto): CoordinateInterface
    {
        try {
            $coordinate = $this->repository->find($dto->idToString());
        } catch (CoordinateNotFoundException $e) {
            throw $e;
        }

        return $coordinate;
    }
}
