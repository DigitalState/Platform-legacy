<?php

namespace Ds\Bundle\SSOBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Ds\Bundle\SSOBundle\DependencyInjection\Compiler\OAuthUserProviderPass;
use Ds\Bundle\SSOBundle\DependencyInjection\Compiler\EventPass;

/**
 * Class DsSSOBundle
 */
class DsSSOBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new OAuthUserProviderPass);
        $container->addCompilerPass(new EventPass);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'OroSSOBundle';
    }
}
