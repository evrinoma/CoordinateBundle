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

namespace Evrinoma\CoordinateBundle\Mediator;

use Evrinoma\CoordinateBundle\Dto\CoordinateApiDtoInterface;
use Evrinoma\CoordinateBundle\Exception\CoordinateCannotBeCreatedException;
use Evrinoma\CoordinateBundle\Exception\CoordinateCannotBeRemovedException;
use Evrinoma\CoordinateBundle\Exception\CoordinateCannotBeSavedException;
use Evrinoma\CoordinateBundle\Model\Coordinate\CoordinateInterface;

interface CommandMediatorInterface
{
    /**
     * @param CoordinateApiDtoInterface $dto
     * @param CoordinateInterface       $entity
     *
     * @return CoordinateInterface
     *
     * @throws CoordinateCannotBeSavedException
     */
    public function onUpdate(CoordinateApiDtoInterface $dto, CoordinateInterface $entity): CoordinateInterface;

    /**
     * @param CoordinateApiDtoInterface $dto
     * @param CoordinateInterface       $entity
     *
     * @throws CoordinateCannotBeRemovedException
     */
    public function onDelete(CoordinateApiDtoInterface $dto, CoordinateInterface $entity): void;

    /**
     * @param CoordinateApiDtoInterface $dto
     * @param CoordinateInterface       $entity
     *
     * @return CoordinateInterface
     *
     * @throws CoordinateCannotBeSavedException
     * @throws CoordinateCannotBeCreatedException
     */
    public function onCreate(CoordinateApiDtoInterface $dto, CoordinateInterface $entity): CoordinateInterface;
}
