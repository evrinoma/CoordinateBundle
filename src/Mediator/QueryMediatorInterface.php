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
use Evrinoma\UtilsBundle\QueryBuilder\QueryBuilderInterface;

interface QueryMediatorInterface
{
    /**
     * @return string
     */
    public function alias(): string;

    /**
     * @param CoordinateApiDtoInterface $dto
     * @param QueryBuilderInterface     $builder
     *
     * @return mixed
     */
    public function createQuery(CoordinateApiDtoInterface $dto, QueryBuilderInterface $builder): void;

    /**
     * @param CoordinateApiDtoInterface $dto
     * @param QueryBuilderInterface     $builder
     *
     * @return array
     */
    public function getResult(CoordinateApiDtoInterface $dto, QueryBuilderInterface $builder): array;
}
