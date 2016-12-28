<?php

namespace Ds\Bundle\BpmCamundaBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Oro\Bundle\ConfigBundle\DependencyInjection\SettingsBuilder;

/**
 * Class Configuration
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder;
        $rootNode = $treeBuilder->root('ds_bpm_camunda');

        SettingsBuilder::append($rootNode, [
            'host' => [
                'type' => 'string',
                'value' => 'http://localhost:8080/engine-rest'
            ]
        ]);

        return $treeBuilder;
    }
}
