<?php

namespace Ds\Bundle\ServiceBundle\Migrations\Schema\v1_0;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * Class DsServiceBundle
 */
class DsServiceBundle implements Migration
{
    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $this->createServiceTable($schema);
        $this->createServiceActivationTable($schema);
        $this->createServiceButtonTable($schema);
        $this->createServiceDescriptionTable($schema);
        $this->createServicePresentationTable($schema);
        $this->createServiceTitleTable($schema);
        $this->addServiceForeignKeys($schema);
        $this->addServiceActivationForeignKeys($schema);
        $this->addServiceButtonForeignKeys($schema);
        $this->addServiceDescriptionForeignKeys($schema);
        $this->addServicePresentationForeignKeys($schema);
        $this->addServiceTitleForeignKeys($schema);
    }

    /**
     * Create service table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createServiceTable(Schema $schema)
    {
        $table = $schema->createTable('ds_service');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->addColumn('business_unit_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime', []);
        $table->addColumn('updated_at', 'datetime', []);
        $table->addColumn('slug', 'string', ['length' => 255]);
        $table->addColumn('icon', 'string', ['length' => 255]);
        $table->addColumn('discriminator', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
        $table->addUniqueIndex(['slug'], 'UNIQ_25F97AA989D9B62');
        $table->addIndex(['business_unit_owner_id'], 'IDX_25F97AA59294170', []);
        $table->addIndex(['organization_id'], 'IDX_25F97AA32C8A3DE', []);
    }

    /**
     * Create service activation table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createServiceActivationTable(Schema $schema)
    {
        $table = $schema->createTable('ds_service_activation');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->addColumn('business_unit_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('user_id', 'integer', ['notnull' => false]);
        $table->addColumn('service_id', 'integer', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime', []);
        $table->addColumn('updated_at', 'datetime', []);
        $table->addColumn('discriminator', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['service_id'], 'IDX_A0486889ED5CA9E6', []);
        $table->addIndex(['user_id'], 'IDX_A0486889A76ED395', []);
        $table->addIndex(['business_unit_owner_id'], 'IDX_A048688959294170', []);
        $table->addIndex(['organization_id'], 'IDX_A048688932C8A3DE', []);
    }

    /**
     * Create service button table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createServiceButtonTable(Schema $schema)
    {
        $table = $schema->createTable('ds_service_button');
        $table->addColumn('service_id', 'integer', []);
        $table->addColumn('localized_value_id', 'integer', []);
        $table->setPrimaryKey(['service_id', 'localized_value_id']);
        $table->addUniqueIndex(['localized_value_id'], 'UNIQ_CF8FC3A0EB576E89');
        $table->addIndex(['service_id'], 'IDX_CF8FC3A0ED5CA9E6', []);
    }

    /**
     * Create service description table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createServiceDescriptionTable(Schema $schema)
    {
        $table = $schema->createTable('ds_service_description');
        $table->addColumn('service_id', 'integer', []);
        $table->addColumn('localized_value_id', 'integer', []);
        $table->setPrimaryKey(['service_id', 'localized_value_id']);
        $table->addUniqueIndex(['localized_value_id'], 'UNIQ_A0187125EB576E89');
        $table->addIndex(['service_id'], 'IDX_A0187125ED5CA9E6', []);
    }

    /**
     * Create service presentation table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createServicePresentationTable(Schema $schema)
    {
        $table = $schema->createTable('ds_service_presentation');
        $table->addColumn('service_id', 'integer', []);
        $table->addColumn('localized_value_id', 'integer', []);
        $table->setPrimaryKey(['service_id', 'localized_value_id']);
        $table->addUniqueIndex(['localized_value_id'], 'UNIQ_2A24518EB576E89');
        $table->addIndex(['service_id'], 'IDX_2A24518ED5CA9E6', []);
    }

    /**
     * Create service title table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createServiceTitleTable(Schema $schema)
    {
        $table = $schema->createTable('ds_service_title');
        $table->addColumn('service_id', 'integer', []);
        $table->addColumn('localized_value_id', 'integer', []);
        $table->setPrimaryKey(['service_id', 'localized_value_id']);
        $table->addUniqueIndex(['localized_value_id'], 'UNIQ_AD9DB23CEB576E89');
        $table->addIndex(['service_id'], 'IDX_AD9DB23CED5CA9E6', []);
    }

    /**
     * Add service foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addServiceForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_service');
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
    }

    /**
     * Add service activation foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addServiceActivationForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_service_activation');
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
            $schema->getTable('ds_service'),
            ['service_id'],
            ['id'],
            ['onDelete' => 'SET NULL', 'onUpdate' => null]
        );
    }

    /**
     * Add service button foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addServiceButtonForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_service_button');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_fallback_localization_val'),
            ['localized_value_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_service'),
            ['service_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }

    /**
     * Add service description foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addServiceDescriptionForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_service_description');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_fallback_localization_val'),
            ['localized_value_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_service'),
            ['service_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }

    /**
     * Add service presentation foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addServicePresentationForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_service_presentation');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_fallback_localization_val'),
            ['localized_value_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_service'),
            ['service_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }

    /**
     * Add service title foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addServiceTitleForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_service_title');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_fallback_localization_val'),
            ['localized_value_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_service'),
            ['service_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }
}
