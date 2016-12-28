<?php

namespace Ds\Bundle\SSOLinkedinBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('ds_sso_linkedin');

        SettingsBuilder::append($rootNode, [
            'enable_sso' => [
                'value' => false,
                'type' => 'boolean'
            ]
        ]);

        return $treeBuilder;
    }
}
