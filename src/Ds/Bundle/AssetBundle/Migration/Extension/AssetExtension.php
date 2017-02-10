<?php

namespace Ds\Bundle\AssetBundle\Migration\Extension;

use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\EntityExtendBundle\Migration\OroOptions;
use Oro\Bundle\EntityExtendBundle\Tools\ExtendHelper;

/**
 * Class AssetExtension
 */
class AssetExtension implements ExtendExtensionAwareInterface
{
    /**
     * @var \Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension
     */
    protected $extendExtension; # region accessors

    /**
     * {@inheritdoc}
     */
    public function setExtendExtension(ExtendExtension $extendExtension)
    {
        $this->extendExtension = $extendExtension;
    }

    # endregion

    /**
     * Adds the association between the target table and the entity table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     * @param string $targetTableName
     * @param string $targetColumnName
     */
    public function addAssetAssociation(Schema $schema, $targetTableName, $targetColumnName = null) {
        $assetTable = $schema->getTable('ds_asset');
        $targetTable = $schema->getTable($targetTableName);

        if (!$targetColumnName) {
            $primaryKeyColumns = $targetTable->getPrimaryKeyColumns();
            $targetColumnName = array_shift($primaryKeyColumns);
        }

        $options = new OroOptions;
        $options->set('asset', 'enabled', true);
        $targetTable->addOption(OroOptions::KEY, $options);
        $associationName = ExtendHelper::buildAssociationName($this->extendExtension->getEntityClassByTableName($targetTableName));
        $this->extendExtension->addManyToOneRelation($schema, $assetTable, $associationName, $targetTable, $targetColumnName);
    }
}
