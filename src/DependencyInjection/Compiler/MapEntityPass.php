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

namespace Evrinoma\PhoneBundle\DependencyInjection\Compiler;

use Evrinoma\PhoneBundle\DependencyInjection\EvrinomaPhoneExtension;
use Evrinoma\PhoneBundle\Model\Phone\PhoneInterface;
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
        if ('orm' === $container->getParameter('evrinoma.phone.storage')) {
            $this->setContainer($container);

            $driver = $container->findDefinition('doctrine.orm.default_metadata_driver');
            $referenceAnnotationReader = new Reference('annotations.reader');

            $this->cleanMetadata($driver, [EvrinomaPhoneExtension::ENTITY]);

            $entityPhone = $container->getParameter('evrinoma.phone.entity');
            if (str_contains($entityPhone, EvrinomaPhoneExtension::ENTITY)) {
                $this->loadMetadata($driver, $referenceAnnotationReader, '%s/Model/Phone', '%s/Entity/Phone');
            }
            $this->addResolveTargetEntity([$entityPhone => [PhoneInterface::class => []]], false);
        }
    }
}
