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

namespace Evrinoma\CoordinateBundle;

use Evrinoma\CoordinateBundle\DependencyInjection\Compiler\Constraint\Property\CoordinatePass;
use Evrinoma\CoordinateBundle\DependencyInjection\Compiler\DecoratorPass;
use Evrinoma\CoordinateBundle\DependencyInjection\Compiler\MapEntityPass;
use Evrinoma\CoordinateBundle\DependencyInjection\Compiler\ServicePass;
use Evrinoma\CoordinateBundle\DependencyInjection\EvrinomaCoordinateExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EvrinomaCoordinateBundle extends Bundle
{
    public const BUNDLE = 'coordinate';

    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container
            ->addCompilerPass(new MapEntityPass($this->getNamespace(), $this->getPath()))
            ->addCompilerPass(new DecoratorPass())
            ->addCompilerPass(new ServicePass())
            ->addCompilerPass(new CoordinatePass())
        ;
    }

    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new EvrinomaCoordinateExtension();
        }

        return $this->extension;
    }
}
