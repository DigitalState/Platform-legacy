<?php

namespace Ds\Bundle\AssetBundle\Tools;

use Oro\Bundle\EntityExtendBundle\Tools\GeneratorExtensions\AbstractAssociationEntityGeneratorExtension;

/**
 * Class AssetEntityGeneratorExtension
 */
class AssetEntityGeneratorExtension extends AbstractAssociationEntityGeneratorExtension
{
    /**
     * {@inheritdoc}
     */
    public function supports(array $schema)
    {
        return $schema['class'] === 'Ds\Bundle\AssetBundle\Entity\Asset' && parent::supports($schema);
    }
}
