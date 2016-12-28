<?php

namespace Ds\Bundle\CommunicationBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Ds\Bundle\CommunicationBundle\DependencyInjection\Compiler\ChannelPass;
use Ds\Bundle\CommunicationBundle\DependencyInjection\Compiler\CriterionPass;

/**
 * Class DsCommunicationBundle
 */
class DsCommunicationBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container
            ->addCompilerPass(new ChannelPass)
            ->addCompilerPass(new CriterionPass);
    }
}
