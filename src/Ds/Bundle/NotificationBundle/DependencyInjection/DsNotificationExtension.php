<?php

namespace Ds\Bundle\NotificationBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class DsNotificationExtension
 */
class DsNotificationExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration;
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('criteria.yml');
        $loader->load('data.yml');
        $loader->load('forms.yml');
        $loader->load('managers.yml');
        $loader->load('repositories.yml');
        $loader->load('widgets.yml');
    }
}
