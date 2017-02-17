<?php

namespace Ds\Bundle\PortalBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('ds_portal');

        SettingsBuilder::append($rootNode, [
            'title' => [
                'type' => 'string',
                'value' => 'Portal'
            ],
            'meta_title' => [
                'type' => 'string',
                'value' => 'Portal'
            ],
            'meta_description' => [
                'type' => 'string',
                'value' => ''
            ],
            'meta_keywords' => [
                'type' => 'string',
                'value' => ''
            ],
            'meta_author' => [
                'type' => 'string',
                'value' => ''
            ]
        ]);

        return $treeBuilder;
    }
}
