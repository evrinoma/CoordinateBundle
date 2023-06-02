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
use Evrinoma\CoordinateBundle\Exception\CoordinateCannotBeRemovedException;
use Evrinoma\CoordinateBundle\Exception\CoordinateInvalidException;
use Evrinoma\CoordinateBundle\Exception\CoordinateNotFoundException;
use Evrinoma\CoordinateBundle\Model\Coordinate\CoordinateInterface;

interface CommandManagerInterface
{
    /**
     * @param CoordinateApiDtoInterface $dto
     *
     * @return CoordinateInterface
     *
     * @throws CoordinateInvalidException
     */
    public function post(CoordinateApiDtoInterface $dto): CoordinateInterface;

    /**
     * @param CoordinateApiDtoInterface $dto
     *
     * @return CoordinateInterface
     *
     * @throws CoordinateInvalidException
     * @throws CoordinateNotFoundException
     */
    public function put(CoordinateApiDtoInterface $dto): CoordinateInterface;

    /**
     * @param CoordinateApiDtoInterface $dto
     *
     * @throws CoordinateCannotBeRemovedException
     * @throws CoordinateNotFoundException
     */
    public function delete(CoordinateApiDtoInterface $dto): void;
}
