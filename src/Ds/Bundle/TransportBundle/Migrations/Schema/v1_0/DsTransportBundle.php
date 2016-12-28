<?php

namespace Ds\Bundle\TransportBundle\Migrations\Schema\v1_0;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * Class DsTransportBundle
 */
class DsTransportBundle implements Migration
{
    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $this->createTransportTable($schema);
        $this->createTransportProfileTable($schema);
        $this->addTransportForeignKeys($schema);
        $this->addTransportProfileForeignKeys($schema);
    }

    /**
     * Create transport table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createTransportTable(Schema $schema)
    {
        $table = $schema->createTable('ds_transport');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->addColumn('business_unit_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime', []);
        $table->addColumn('updated_at', 'datetime', []);
        $table->addColumn('title', 'string', ['length' => 255]);
        $table->addColumn('implementation', 'string', ['length' => 255]);
        $table->addColumn('data', 'json_array', ['comment' => '(DC2Type:json_array)']);
        $table->addColumn('discriminator', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['business_unit_owner_id'], 'IDX_FFFC4DAF59294170', []);
        $table->addIndex(['organization_id'], 'IDX_FFFC4DAF32C8A3DE', []);
    }

    /**
     * Create transport profile table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createTransportProfileTable(Schema $schema)
    {
        $table = $schema->createTable('ds_transport_profile');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->addColumn('business_unit_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('transport_id', 'integer', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime', []);
        $table->addColumn('updated_at', 'datetime', []);
        $table->addColumn('title', 'string', ['length' => 255]);
        $table->addColumn('data', 'json_array', ['comment' => '(DC2Type:json_array)']);
        $table->addColumn('discriminator', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['transport_id'], 'IDX_B9AB4059909C13F', []);
        $table->addIndex(['business_unit_owner_id'], 'IDX_B9AB40559294170', []);
        $table->addIndex(['organization_id'], 'IDX_B9AB40532C8A3DE', []);
    }

    /**
     * Add transport foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addTransportForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_transport');
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
     * Add transport profile foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addTransportProfileForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_transport_profile');
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
            $schema->getTable('ds_transport'),
            ['transport_id'],
            ['id'],
            ['onDelete' => null, 'onUpdate' => null]
        );
    }
}
