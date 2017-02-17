<?php

namespace Ds\Bundle\CommunicationBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class CriterionPass
 */
class CriterionPass implements CompilerPassInterface
{
    /**
     * Process
     *
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('ds.communication.collection.criterion')) {
            return;
        }

        $definition = $container->findDefinition('ds.communication.collection.criterion');
        $services = $container->findTaggedServiceIds('ds.communication.criterion');

        foreach ($services as $id => $tags) {
            foreach ($tags as $tag) {
                $implementation = array_key_exists('implementation', $tag) ? $tag['implementation'] : null;
                $definition->addMethodCall('add', [ [
                    'criterion' => new Reference($id),
                    'implementation' => $implementation
                ] ]);
            }
        }
    }
}
