<?php

namespace Ds\Bundle\DataBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class ResolverPass
 */
class ResolverPass implements CompilerPassInterface
{
    /**
     * Process
     *
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('ds.data.data')) {
            return;
        }

        $definition = $container->findDefinition('ds.data.data');
        $services = $container->findTaggedServiceIds('ds.data.resolver');

        foreach ($services as $id => $tags) {
            foreach ($tags as $tag) {
                $definition->addMethodCall('addResolver', [ new Reference($id) ]);
            }
        }
    }
}
