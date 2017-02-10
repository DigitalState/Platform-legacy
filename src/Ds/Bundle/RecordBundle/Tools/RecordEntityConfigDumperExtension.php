<?php

namespace Ds\Bundle\RecordBundle\Tools;

use Oro\Bundle\EntityExtendBundle\Tools\DumperExtensions\AssociationEntityConfigDumperExtension;

/**
 * Class RecordEntityConfigDumperExtension
 */
class RecordEntityConfigDumperExtension extends AssociationEntityConfigDumperExtension
{
    /**
     * {@inheritdoc}
     */
    protected function getAssociationEntityClass()
    {
        return 'Ds\Bundle\RecordBundle\Entity\Record';
    }

    /**
     * {@inheritdoc}
     */
    protected function getAssociationScope()
    {
        return 'record';
    }
}
