<?php

namespace Ds\Bundle\DataBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Ds\Bundle\DataBundle\DependencyInjection\Compiler\ResolverPass;

/**
 * Class DsDataBundle
 */
class DsDataBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ResolverPass);
    }
}
