<?php

namespace Ds\Bundle\AssetBundle\Tools;

use Oro\Bundle\EntityExtendBundle\Tools\DumperExtensions\AssociationEntityConfigDumperExtension;

/**
 * Class AssetEntityConfigDumperExtension
 */
class AssetEntityConfigDumperExtension extends AssociationEntityConfigDumperExtension
{
    /**
     * {@inheritdoc}
     */
    protected function getAssociationEntityClass()
    {
        return 'Ds\Bundle\AssetBundle\Entity\Asset';
    }

    /**
     * {@inheritdoc}
     */
    protected function getAssociationScope()
    {
        return 'asset';
    }
}
