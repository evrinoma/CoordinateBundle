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

interface DtoPreValidatorInterface
{
    /**
     * @param CoordinateApiDtoInterface $dto
     *
     * @throws CoordinateInvalidException
     */
    public function onPost(CoordinateApiDtoInterface $dto): void;

    /**
     * @param CoordinateApiDtoInterface $dto
     *
     * @throws CoordinateInvalidException
     */
    public function onPut(CoordinateApiDtoInterface $dto): void;

    /**
     * @param CoordinateApiDtoInterface $dto
     *
     * @throws CoordinateInvalidException
     */
    public function onDelete(CoordinateApiDtoInterface $dto): void;
}
