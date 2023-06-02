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

namespace Evrinoma\CoordinateBundle\Dto\Preserve;

use Evrinoma\CoordinateBundle\DtoCommon\ValueObject\Preserve\AltitudeTrait;
use Evrinoma\CoordinateBundle\DtoCommon\ValueObject\Preserve\LatitudeTrait;
use Evrinoma\CoordinateBundle\DtoCommon\ValueObject\Preserve\LongitudeTrait;
use Evrinoma\DtoCommon\ValueObject\Preserve\IdTrait;

trait CoordinateApiDtoTrait
{
    use AltitudeTrait;
    use IdTrait;
    use LatitudeTrait;
    use LongitudeTrait;
}
