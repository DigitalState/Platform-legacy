<?php

namespace Ds\Bundle\RecordBundle\Migrations\Schema\v1_0;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * Class DsRecordBundle
 */
class DsRecordBundle implements Migration
{
    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $this->createRecordTable($schema);
        $this->createRecordTitleTable($schema);
        $this->addRecordForeignKeys($schema);
        $this->addRecordTitleForeignKeys($schema);
    }

    /**
     * Create record table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createRecordTable(Schema $schema)
    {
        $table = $schema->createTable('ds_record');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->addColumn('business_unit_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('case_id', 'integer', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime', []);
        $table->addColumn('updated_at', 'datetime', []);
        $table->addColumn('type', 'string', ['length' => 255]);
        $table->addColumn('source', 'string', ['length' => 255]);
        $table->addColumn('data', 'json_array', ['comment' => '(DC2Type:json_array)']);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['case_id'], 'IDX_3A32F519CF10D4F5', []);
        $table->addIndex(['business_unit_owner_id'], 'IDX_3A32F51959294170', []);
        $table->addIndex(['organization_id'], 'IDX_3A32F51932C8A3DE', []);
    }

    /**
     * Create record title table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createRecordTitleTable(Schema $schema)
    {
        $table = $schema->createTable('ds_record_title');
        $table->addColumn('record_id', 'integer', []);
        $table->addColumn('localized_value_id', 'integer', []);
        $table->setPrimaryKey(['record_id', 'localized_value_id']);
        $table->addUniqueIndex(['localized_value_id'], 'UNIQ_A5559B9BEB576E89');
        $table->addIndex(['record_id'], 'IDX_A5559B9BED5CA9E6', []);
    }

    /**
     * Add record foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addRecordForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_record');
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
            $schema->getTable('ds_case'),
            ['case_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }

    /**
     * Add record title foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addRecordTitleForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_record_title');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_fallback_localization_val'),
            ['localized_value_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_record'),
            ['record_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }
}
