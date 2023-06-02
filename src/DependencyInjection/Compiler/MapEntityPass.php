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

namespace Evrinoma\CoordinateBundle\DependencyInjection\Compiler;

use Evrinoma\CoordinateBundle\DependencyInjection\EvrinomaCoordinateExtension;
use Evrinoma\CoordinateBundle\Model\Coordinate\CoordinateInterface;
use Evrinoma\UtilsBundle\DependencyInjection\Compiler\AbstractMapEntity;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class MapEntityPass extends AbstractMapEntity implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        if ('orm' === $container->getParameter('evrinoma.coordinate.storage')) {
            $this->setContainer($container);

            $driver = $container->findDefinition('doctrine.orm.default_metadata_driver');
            $referenceAnnotationReader = new Reference('annotations.reader');

            $this->cleanMetadata($driver, [EvrinomaCoordinateExtension::ENTITY]);

            $entityCoordinate = $container->getParameter('evrinoma.coordinate.entity');
            if (str_contains($entityCoordinate, EvrinomaCoordinateExtension::ENTITY)) {
                $this->loadMetadata($driver, $referenceAnnotationReader, '%s/Model/Coordinate', '%s/Entity/Coordinate');
            }
            $this->addResolveTargetEntity([$entityCoordinate => [CoordinateInterface::class => []]], false);
        }
    }
}
