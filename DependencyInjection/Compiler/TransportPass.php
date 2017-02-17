<?php

namespace Ds\Bundle\TransportBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class TransportPass
 */
class TransportPass implements CompilerPassInterface
{
    /**
     * Process
     *
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('ds.transport.collection.transport')) {
            return;
        }

        $definition = $container->findDefinition('ds.transport.collection.transport');
        $services = $container->findTaggedServiceIds('ds.transport');

        foreach ($services as $id => $tags) {
            foreach ($tags as $tag) {
                $implementation = array_key_exists('implementation', $tag) ? $tag['implementation'] : null;
                $definition->addMethodCall('add', [ [
                    'transport' => new Reference($id),
                    'implementation' => $implementation
                ] ]);
            }
        }
    }
}
