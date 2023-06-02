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

use Evrinoma\TestUtilsBundle\ValueObject\Common\AbstractId;

class Longitude extends AbstractId
{
    protected static string $value = '65.341118';
    protected static string $default = '66.341118';

    public static function default(): string
    {
        return static::$default;
    }
}
