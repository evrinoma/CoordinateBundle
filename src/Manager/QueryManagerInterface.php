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

interface QueryManagerInterface
{
    /**
     * @param CoordinateApiDtoInterface $dto
     *
     * @return array
     *
     * @throws CoordinateNotFoundException
     */
    public function criteria(CoordinateApiDtoInterface $dto): array;

    /**
     * @param CoordinateApiDtoInterface $dto
     *
     * @return CoordinateInterface
     *
     * @throws CoordinateNotFoundException
     */
    public function get(CoordinateApiDtoInterface $dto): CoordinateInterface;

    /**
     * @param CoordinateApiDtoInterface $dto
     *
     * @return CoordinateInterface
     *
     * @throws CoordinateProxyException
     */
    public function proxy(CoordinateApiDtoInterface $dto): CoordinateInterface;
}
