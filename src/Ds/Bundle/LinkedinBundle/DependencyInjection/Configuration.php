<?php

namespace Ds\Bundle\LinkedinBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Oro\Bundle\ConfigBundle\DependencyInjection\SettingsBuilder;

/**
 * Configuration
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder;
        $rootNode = $treeBuilder->root('ds_linkedin');

        SettingsBuilder::append($rootNode, [
            'client_id' => [
                'value' => '',
                'type' => 'text',
            ],
            'client_secret' => [
                'value' => '',
                'type' => 'text',
            ]
        ]);

        return $treeBuilder;
    }
}
