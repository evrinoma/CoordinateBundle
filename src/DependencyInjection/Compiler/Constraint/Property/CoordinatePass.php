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

namespace Evrinoma\CoordinateBundle\DependencyInjection\Compiler\Constraint\Property;

use Evrinoma\CoordinateBundle\Validator\CoordinateValidator;
use Evrinoma\UtilsBundle\DependencyInjection\Compiler\AbstractConstraint;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class CoordinatePass extends AbstractConstraint implements CompilerPassInterface
{
    public const COORDINATE_CONSTRAINT = 'evrinoma.coordinate.constraint.property';

    protected static string $alias = self::COORDINATE_CONSTRAINT;
    protected static string $class = CoordinateValidator::class;
    protected static string $methodCall = 'addPropertyConstraint';
}
