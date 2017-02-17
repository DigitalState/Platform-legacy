<?php

namespace Ds\Bundle\SSOBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use LogicException;

/**
 * Class AbstractHwiConfigurationPass
 */
abstract class AbstractHwiConfigurationPass implements CompilerPassInterface
{
    /**
     * @const string
     */
    const RESOURCE_OWNER = null;

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (null === static::RESOURCE_OWNER) {
            throw new LogicException('Resource owner is not defined.');
        }

        $id = 'hwi_oauth.resource_owner.' . static::RESOURCE_OWNER;

        if (!$container->hasDefinition($id)) {
            return;
        }

        $definition = $container->findDefinition($id);
        $definition->addMethodCall('configureCredentials', [ new Reference('oro_config.global') ]);
    }
}
