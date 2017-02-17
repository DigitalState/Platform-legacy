<?php

namespace Ds\Bundle\TransportBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Ds\Bundle\TransportBundle\DependencyInjection\Compiler\TransportPass;

/**
 * Class DsTransportBundle
 */
class DsTransportBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new TransportPass);
    }
}
