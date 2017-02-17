<?php

namespace Ds\Bundle\BpmBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class DsBpmExtension
 */
class DsBpmExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration;
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('bpm.yml');
        $loader->load('collections.yml');
        $loader->load('data.yml');
        $loader->load('forms.yml');
        $loader->load('repositories.yml');

        $container->prependExtensionConfig($this->getAlias(), array_intersect_key($config, array_flip([ 'settings' ])));
    }
}
