<?php

namespace Ds\Bundle\SSOLinkedinBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Ds\Bundle\SSOLinkedinBundle\DependencyInjection\Compiler\HwiConfigurationPass;

/**
 * Class DsSSOLinkedinBundle
 */
class DsSSOLinkedinBundle extends Bundle
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
