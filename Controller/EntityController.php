<?php

namespace Ds\Bundle\EntityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class EntityController
 */
class EntityController extends Controller
{
    /**
     * @var string
     */
    protected $type;

    /**
     * Constructor
     *
     * @param string $type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Get class
     *
     * @param string $alias
     * @return string
     */
    protected function getClass($alias = '')
    {
        $provider = $this->get('oro_entity_config.provider.entity');
        $configs = $provider->getConfigs();

        foreach ($configs as $config) {
            if ($config->get('type') === $this->type && $config->get('alias') === $alias) {
                return $config->getId()->getclassName();
            }
        }
    }

    /**
     * Get meta
     *
     * @param object|string $entity
     * @return \Oro\Bundle\EntityConfigBundle\Metadata\EntityMetadata
     */
    protected function getMeta($entity)
    {
        if (is_object($entity)) {
            $entity = get_class($entity);
        }

        $manager = $this->get('oro_entity_config.config_manager');
        $meta = $manager->getEntityMetadata($entity);

        return $meta;
    }

    /**
     * Get meta by alias
     *
     * @param string $alias
     * @return \Oro\Bundle\EntityConfigBundle\Metadata\EntityMetadata
     */
    protected function getMetaByAlias($alias = '')
    {
        return $this->getMeta($this->getClass($alias));
    }

    /**
     * Get config
     *
     * @param string $scope
     * @param object|string $entity
     * @return \Oro\Bundle\EntityConfigBundle\Config\Config
     */
    protected function getConfig($scope, $entity)
    {
        if (is_object($entity)) {
            $entity = get_class($entity);
        }

        $provider = $this->get('oro_entity_config.provider.' . $scope);
        $config = $provider->getConfig($entity);

        return $config;
    }

    /**
     * Get config by alias
     *
     * @param string $scope
     * @param string $alias
     * @return \Oro\Bundle\EntityConfigBundle\Config\Config
     */
    protected function getConfigByAlias($scope, $alias = '')
    {
        return $this->getConfig($scope, $this->getClass($alias));
    }
}
