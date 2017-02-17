<?php

namespace Ds\Bundle\SSOTwitterBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Ds\Bundle\SSOTwitterBundle\DependencyInjection\Compiler\HwiConfigurationPass;

/**
 * Class DsSSOTwitterBundle
 */
class DsSSOTwitterBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new HwiConfigurationPass);
    }
}
