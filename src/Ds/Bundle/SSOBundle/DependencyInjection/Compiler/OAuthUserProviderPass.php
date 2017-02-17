<?php

namespace Ds\Bundle\SSOBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class OAuthUserProviderPass
 */
class OAuthUserProviderPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('ds.sso.collection.oauth_user_provider')) {
            return;
        }

        $definition = $container->findDefinition('ds.sso.collection.oauth_user_provider');
        $services = $container->findTaggedServiceIds('ds.oauth.user.provider');

        foreach ($services as $id => $tags) {
            foreach ($tags as $tag) {
                $alias = array_key_exists('alias', $tag) ? $tag['alias'] : null;
                $definition->addMethodCall('add', [ [ 'provider' => new Reference($id), 'alias' => $alias ] ]);
            }
        }
    }
}
