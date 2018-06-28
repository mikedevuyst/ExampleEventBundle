<?php

/*
 * This file is part of Sulu.
 *
 * (c) MASSIVE ART WebServices GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sulu\Bundle\ExampleEventBundle\DependencyInjection;

use Sulu\Bundle\ExampleEventBundle\Model\Event;
use Sulu\Component\HttpKernel\SuluKernel;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class ExampleEventExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('handler.xml');
        $loader->load('commandbus.xml');
        $loader->load('services.xml');
    }

    public function prepend(ContainerBuilder $container)
    {
        if (!$container->hasExtension('jms_serializer')) {
            throw new \RuntimeException('Missing JmsSerializerBundle.');
        }

        $container->prependExtensionConfig(
            'jms_serializer',
            [
                'metadata' => [
                    'directories' => [
                        [
                            'name' => 'ExampleEventBundle',
                            'path' => __DIR__ . '/../Resources/config/serializer',
                            'namespace_prefix' => 'Sulu\\Bundle\\ExampleEventBundle\\Model',
                        ],
                    ],
                ],
            ]
        );

        if (!$container->hasExtension('doctrine')) {
            throw new \RuntimeException('Missing DoctrineBundle.');
        }

        $container->prependExtensionConfig(
            'doctrine',
            [
                'orm' => [
                    'entity_managers' => [
                        'default' => [
                            'mappings' => [
                                'ExampleEventBundle' => [
                                    'type' => 'xml',
                                    'prefix' => 'Sulu\\Bundle\\ExampleEventBundle\\Model',
                                    'dir' => 'Resources/config/doctrine',
                                    'alias' => 'ExampleEventBundle',
                                    'is_bundle' => true,
                                    'mapping' => true,
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->prependAdmin($container);
    }

    private function prependAdmin(ContainerBuilder $container)
    {
        if (SuluKernel::CONTEXT_ADMIN !== $container->getParameter('sulu.context')) {
            return;
        }

        if (!$container->hasExtension('sulu_admin')) {
            throw new \RuntimeException('Missing SuluAdminBundle.');
        }

        $container->prependExtensionConfig(
            'sulu_admin',
            [
                'resources' => [
                    'events' => [
                        'form' => ['@ExampleEventBundle/Resources/config/forms/Event.xml'],
                        'datagrid' => Event::class,
                        'endpoint' => 'sulu_example_event.get_events',
                    ],
                ],
            ]
        );
    }
}
