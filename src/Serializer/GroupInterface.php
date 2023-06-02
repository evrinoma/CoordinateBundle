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

namespace Evrinoma\CoordinateBundle\Serializer;

interface GroupInterface
{
    public const API_POST_COORDINATE = 'API_POST_COORDINATE';
    public const API_PUT_COORDINATE = 'API_PUT_COORDINATE';
    public const API_GET_COORDINATE = 'API_GET_COORDINATE';
    public const API_CRITERIA_COORDINATE = self::API_GET_COORDINATE;
    public const APP_GET_BASIC_COORDINATE = 'APP_GET_BASIC_COORDINATE';
}
