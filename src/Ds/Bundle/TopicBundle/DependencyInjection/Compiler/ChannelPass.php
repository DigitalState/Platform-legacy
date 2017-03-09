<?php

namespace Ds\Bundle\TopicBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class ChannelPass
 */
class ChannelPass implements CompilerPassInterface
{
    /**
     * Process
     *
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('ds.topic.collection.channel')) {
            return;
        }

        $definition = $container->findDefinition('ds.topic.collection.channel');
        $services = $container->findTaggedServiceIds('ds.topic.channel');

        foreach ($services as $id => $tags) {
            foreach ($tags as $tag) {
                $implementation = array_key_exists('implementation', $tag) ? $tag['implementation'] : null;
                $definition->addMethodCall('add', [ [
                    'channel' => new Reference($id),
                    'implementation' => $implementation
                ] ]);
            }
        }
    }
}
