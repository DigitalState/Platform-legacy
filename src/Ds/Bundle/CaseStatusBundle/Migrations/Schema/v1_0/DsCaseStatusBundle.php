<?php

namespace Ds\Bundle\CaseStatusBundle\Migrations\Schema\v1_0;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * Class DsCaseStatusBundle
 */
class DsCaseStatusBundle implements Migration
{
    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $this->createCaseStatusTable($schema);
        $this->createCaseStatusDescriptionTable($schema);
        $this->createCaseStatusTitleTable($schema);
        $this->addCaseStatusForeignKeys($schema);
        $this->addCaseStatusDescriptionForeignKeys($schema);
        $this->addCaseStatusTitleForeignKeys($schema);
    }

    /**
     * Create case status table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createCaseStatusTable(Schema $schema)
    {
        $table = $schema->createTable('ds_case_status');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->addColumn('business_unit_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('case_id', 'integer', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime', []);
        $table->addColumn('updated_at', 'datetime', []);
        $table->addColumn('source', 'string', ['length' => 255]);
        $table->addColumn('type', 'string', ['length' => 255]);
        $table->addColumn('percentage', 'smallint', []);
        $table->addColumn('data', 'json_array', ['comment' => '(DC2Type:json_array)']);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['case_id'], 'IDX_B4723F9BCF10D4F5', []);
        $table->addIndex(['business_unit_owner_id'], 'IDX_B4723F9B59294170', []);
        $table->addIndex(['organization_id'], 'IDX_B4723F9B32C8A3DE', []);
    }

    /**
     * Create case status description table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createCaseStatusDescriptionTable(Schema $schema)
    {
        $table = $schema->createTable('ds_case_status_description');
        $table->addColumn('status_id', 'integer', []);
        $table->addColumn('localized_value_id', 'integer', []);
        $table->setPrimaryKey(['status_id', 'localized_value_id']);
        $table->addUniqueIndex(['localized_value_id'], 'UNIQ_8877B491EB576E89');
        $table->addIndex(['status_id'], 'IDX_8877B491ED5CA9E6', []);
    }

    /**
     * Create case status title table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createCaseStatusTitleTable(Schema $schema)
    {
        $table = $schema->createTable('ds_case_status_title');
        $table->addColumn('status_id', 'integer', []);
        $table->addColumn('localized_value_id', 'integer', []);
        $table->setPrimaryKey(['status_id', 'localized_value_id']);
        $table->addUniqueIndex(['localized_value_id'], 'UNIQ_864E7B8AEB576E89');
        $table->addIndex(['status_id'], 'IDX_864E7B8AED5CA9E6', []);
    }

    /**
     * Add case status foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addCaseStatusForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_case_status');
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
     * Add case status description foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addCaseStatusDescriptionForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_case_status_description');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_fallback_localization_val'),
            ['localized_value_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_case_status'),
            ['status_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }

    /**
     * Add case status title foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addCaseStatusTitleForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_case_status_title');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_fallback_localization_val'),
            ['localized_value_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_case_status'),
            ['status_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }
}
