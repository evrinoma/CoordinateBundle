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

namespace Evrinoma\CoordinateBundle\Tests\Functional\ValueObject\Coordinate;

use Evrinoma\TestUtilsBundle\ValueObject\Common\AbstractIdentity;

class Latitude extends AbstractIdentity
{
    protected static string $value = '55.441004';
    protected static string $default = '71.164391';
}
