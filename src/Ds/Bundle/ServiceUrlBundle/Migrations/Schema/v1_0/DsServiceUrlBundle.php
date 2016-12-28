<?php

namespace Ds\Bundle\ServiceUrlBundle\Migrations\Schema\v1_0;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * Class DsServiceUrlBundle
 */
class DsServiceUrlBundle implements Migration
{
    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $this->createServiceUrlTable($schema);
        $this->createServiceUrlUrlTable($schema);
        $this->addServiceUrlForeignKeys($schema);
        $this->addServiceurlUrlForeignKeys($schema);
    }

    /**
     * Create service url table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createServiceUrlTable(Schema $schema)
    {
        $table = $schema->createTable('ds_serviceurl');
        $table->addColumn('id', 'integer', []);
        $table->setPrimaryKey(['id']);
    }

    /**
     * Create service url url table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createServiceUrlUrlTable(Schema $schema)
    {
        $table = $schema->createTable('ds_serviceurl_url');
        $table->addColumn('service_id', 'integer', []);
        $table->addColumn('localized_value_id', 'integer', []);
        $table->setPrimaryKey(['service_id', 'localized_value_id']);
        $table->addUniqueIndex(['localized_value_id'], 'UNIQ_59DBDC0EB576E89');
        $table->addIndex(['service_id'], 'IDX_59DBDC0ED5CA9E6', []);
    }

    /**
     * Add service url foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addServiceUrlForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_serviceurl');
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_service'),
            ['id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }

    /**
     * Add service url url foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addServiceurlUrlForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_serviceurl_url');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_fallback_localization_val'),
            ['localized_value_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_serviceurl'),
            ['service_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }
}
