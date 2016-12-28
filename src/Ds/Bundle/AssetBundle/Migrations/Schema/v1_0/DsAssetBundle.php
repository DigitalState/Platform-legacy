<?php

namespace Ds\Bundle\AssetBundle\Migrations\Schema\v1_0;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * Class DsAssetBundle
 */
class DsAssetBundle implements Migration
{
    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $this->createAssetTable($schema);
        $this->createAssetTitleTable($schema);
        $this->addAssetForeignKeys($schema);
        $this->addAssetTitleForeignKeys($schema);
    }

    /**
     * Create asset table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createAssetTable(Schema $schema)
    {
        $table = $schema->createTable('ds_asset');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->addColumn('business_unit_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('user_id', 'integer', ['notnull' => false]);
        $table->addColumn('case_id', 'integer', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime', []);
        $table->addColumn('updated_at', 'datetime', []);
        $table->addColumn('type', 'string', ['length' => 255]);
        $table->addColumn('source', 'string', ['length' => 255]);
        $table->addColumn('data', 'json_array', ['comment' => '(DC2Type:json_array)']);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['user_id'], 'IDX_D556ACFDA76ED395', []);
        $table->addIndex(['case_id'], 'IDX_D556ACFDCF10D4F5', []);
        $table->addIndex(['business_unit_owner_id'], 'IDX_D556ACFD59294170', []);
        $table->addIndex(['organization_id'], 'IDX_D556ACFD32C8A3DE', []);
    }

    /**
     * Create asset title table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createAssetTitleTable(Schema $schema)
    {
        $table = $schema->createTable('ds_asset_title');
        $table->addColumn('asset_id', 'integer', []);
        $table->addColumn('localized_value_id', 'integer', []);
        $table->setPrimaryKey(['asset_id', 'localized_value_id']);
        $table->addUniqueIndex(['localized_value_id'], 'UNIQ_F0AB6E7CEB576E89');
        $table->addIndex(['asset_id'], 'IDX_F0AB6E7CED5CA9E6', []);
    }

    /**
     * Add asset foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addAssetForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_asset');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_organization'),
            ['organization_id'],
            ['id'],
            ['onDelete' => 'SET NULL', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_business_unit'),
            ['business_unit_owner_id'],
            ['id'],
            ['onDelete' => 'SET NULL', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_user'),
            ['user_id'],
            ['id'],
            ['onDelete' => 'SET NULL', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_case'),
            ['case_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }

    /**
     * Add asset title foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addAssetTitleForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_asset_title');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_fallback_localization_val'),
            ['localized_value_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_asset'),
            ['asset_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }
}
