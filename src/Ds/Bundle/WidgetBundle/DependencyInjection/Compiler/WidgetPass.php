<?php

namespace Ds\Bundle\WidgetBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class WidgetPass
 */
class WidgetPass implements CompilerPassInterface
{
    /**
     * Process
     *
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('ds.widget.collection.widget')) {
            return;
        }

        $definition = $container->findDefinition('ds.widget.collection.widget');
        $services = $container->findTaggedServiceIds('ds.widget');

        foreach ($services as $id => $tags) {
            foreach ($tags as $tag) {
                $position = array_key_exists('position', $tag) ? $tag['position'] : null;
                $context = array_key_exists('context', $tag) ? $tag['context'] : null;
                $enabled = array_key_exists('enabled', $tag) ? $tag['enabled'] : true;

                if ($enabled) {
                    $definition->addMethodCall('addWidget', [ new Reference($id), $position, $context ]);
                }
            }
        }
    }
}
