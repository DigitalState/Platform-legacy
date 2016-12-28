<?php

namespace Ds\Bundle\ServiceBpmBundle\Migrations\Schema\v1_0;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * Class DsServiceBpmBundle
 */
class DsServiceBpmBundle implements Migration
{
    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $this->createServiceBpmTable($schema);
        $this->addServiceBpmForeignKeys($schema);
    }

    /**
     * Create service bpm table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createServiceBpmTable(Schema $schema)
    {
        $table = $schema->createTable('ds_servicebpm');
        $table->addColumn('id', 'integer', []);
        $table->addColumn('bpm', 'string', ['length' => 255]);
        $table->addColumn('bpm_id', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
    }

    /**
     * Add service bpm foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addServiceBpmForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_servicebpm');
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_service'),
            ['id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }
}
