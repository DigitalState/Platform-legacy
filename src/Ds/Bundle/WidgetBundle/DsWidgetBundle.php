<?php

namespace Ds\Bundle\WidgetBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Ds\Bundle\WidgetBundle\DependencyInjection\Compiler\WidgetPass;

/**
 * Class DsWidgetBundle
 */
class DsWidgetBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new WidgetPass);
    }
}
