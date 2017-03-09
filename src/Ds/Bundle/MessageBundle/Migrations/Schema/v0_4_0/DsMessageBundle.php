<?php

namespace Ds\Bundle\MessageBundle\Migrations\Schema\v0_4_0;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * Class DsMessageBundle
 */
class DsMessageBundle implements Migration
{
    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        /** Tables generation **/
        $this->createDsMessageTable($schema);

        /** Foreign keys generation **/
        $this->addDsMessageForeignKeys($schema);
    }

    /**
     * Create ds_message table
     *
     * @param Schema $schema
     */
    protected function createDsMessageTable(Schema $schema)
    {
        $table = $schema->createTable('ds_message');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->addColumn('business_unit_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('user_id', 'integer', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime', []);
        $table->addColumn('updated_at', 'datetime', []);
        $table->addColumn('title', 'string', ['length' => 255]);
        $table->addColumn('presentation', 'text', ['notnull' => false]);
        $table->addColumn('sent_at', 'datetime', ['notnull' => false]);
        $table->addColumn('discriminator', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['user_id'], 'IDX_557F3D07A76ED395', []);
        $table->addIndex(['business_unit_owner_id'], 'IDX_557F3D0759294170', []);
        $table->addIndex(['organization_id'], 'IDX_557F3D0732C8A3DE', []);
    }

    /**
     * Add ds_message foreign keys.
     *
     * @param Schema $schema
     */
    protected function addDsMessageForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_message');
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
            ['onDelete' => null, 'onUpdate' => null]
        );
    }
}
