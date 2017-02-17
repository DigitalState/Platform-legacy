<?php

namespace Ds\Bundle\BpmBundle\DependencyInjection\Compiler\Bpm;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;
use Ds\Bundle\BpmBundle\Event\Bpm;

/**
 * Class EventPass
 */
class EventPass implements CompilerPassInterface
{
    /**
     * Process
     *
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('event_dispatcher')) {
            return;
        }

        $definition = $container->findDefinition('event_dispatcher');
        $events = [
            Bpm\Instance\Start\PreEvent::NAME,
            Bpm\Instance\Start\PostEvent::NAME
        ];

        foreach ($events as $event) {
            $services = $container->findTaggedServiceIds($event);

            foreach ($services as $id => $tags) {
                foreach ($tags as $tag) {
                    $method = '__invoke';

                    if (array_key_exists('method', $tag)) {
                        $method = $tag['method'];
                    }

                    $definition->addMethodCall('addListener', [ $event, [ new Reference($id), $method ] ]);
                }
            }
        }
    }
}
