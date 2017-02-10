<?php

namespace Ds\Bundle\RecordBundle\Tools;

use Oro\Bundle\EntityExtendBundle\Tools\GeneratorExtensions\AbstractAssociationEntityGeneratorExtension;

/**
 * Class RecordEntityGeneratorExtension
 */
class RecordEntityGeneratorExtension extends AbstractAssociationEntityGeneratorExtension
{
    /**
     * {@inheritdoc}
     */
    public function supports(array $schema)
    {
        return $schema['class'] === 'Ds\Bundle\RecordBundle\Entity\Record' && parent::supports($schema);
    }
}
