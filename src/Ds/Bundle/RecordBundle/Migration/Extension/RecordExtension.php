<?php

namespace Ds\Bundle\RecordBundle\Migration\Extension;

use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\EntityExtendBundle\Migration\OroOptions;
use Oro\Bundle\EntityExtendBundle\Tools\ExtendHelper;

/**
 * Class RecordExtension
 */
class RecordExtension implements ExtendExtensionAwareInterface
{
    /**
     * @var \Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension
     */
    protected $extendExtension;

    /**
     * {@inheritdoc}
     */
    public function setExtendExtension(ExtendExtension $extendExtension)
    {
        $this->extendExtension = $extendExtension;
    }

    /**
     * Adds the association between the target table and the entity table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     * @param string $targetTableName
     * @param string $targetColumnName
     */
    public function addRecordAssociation(Schema $schema, $targetTableName, $targetColumnName = null) {
        $recordTable = $schema->getTable('ds_record');
        $targetTable = $schema->getTable($targetTableName);

        if (empty($targetColumnName)) {
            $primaryKeyColumns = $targetTable->getPrimaryKeyColumns();
            $targetColumnName = array_shift($primaryKeyColumns);
        }

        $options = new OroOptions;
        $options->set('record', 'enabled', true);
        $targetTable->addOption(OroOptions::KEY, $options);
        $associationName = ExtendHelper::buildAssociationName($this->extendExtension->getEntityClassByTableName($targetTableName));
        $this->extendExtension->addManyToOneRelation($schema, $recordTable, $associationName, $targetTable, $targetColumnName);
    }
}
