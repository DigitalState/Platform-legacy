<?php

namespace Ds\Bundle\TopicBundle\Migrations\Schema\v0_4_0;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * Class DsTopicBundle
 */
class DsTopicBundle implements Migration
{
    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        /** Tables generation **/
        $this->createDsTopicTable($schema);
        $this->createDsTopicChannelTable($schema);
        $this->createDsTopicChannelDescriptionTable($schema);
        $this->createDsTopicChannelTitleTable($schema);
        $this->createDsTopicDescriptionTable($schema);
        $this->createDsTopicPresentationTable($schema);
        $this->createDsTopicSubscriptionTable($schema);
        $this->createDsTopicSubscriptionChannelTable($schema);
        $this->createDsTopicTitleTable($schema);
        $this->createDsTopicTopicchannelTable($schema);

        /** Foreign keys generation **/
        $this->addDsTopicForeignKeys($schema);
        $this->addDsTopicChannelForeignKeys($schema);
        $this->addDsTopicChannelDescriptionForeignKeys($schema);
        $this->addDsTopicChannelTitleForeignKeys($schema);
        $this->addDsTopicDescriptionForeignKeys($schema);
        $this->addDsTopicPresentationForeignKeys($schema);
        $this->addDsTopicSubscriptionForeignKeys($schema);
        $this->addDsTopicSubscriptionChannelForeignKeys($schema);
        $this->addDsTopicTitleForeignKeys($schema);
        $this->addDsTopicTopicchannelForeignKeys($schema);
    }

    /**
     * Create ds_topic table
     *
     * @param Schema $schema
     */
    protected function createDsTopicTable(Schema $schema)
    {
        $table = $schema->createTable('ds_topic');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->addColumn('business_unit_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime', []);
        $table->addColumn('updated_at', 'datetime', []);
        $table->addColumn('slug', 'string', ['length' => 255]);
        $table->addColumn('icon', 'string', ['length' => 255]);
        $table->addColumn('discriminator', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
        $table->addUniqueIndex(['slug'], 'UNIQ_4AB928BA989D9B62');
        $table->addIndex(['business_unit_owner_id'], 'IDX_4AB928BA59294170', []);
        $table->addIndex(['organization_id'], 'IDX_4AB928BA32C8A3DE', []);
    }

    /**
     * Create ds_topic_channel table
     *
     * @param Schema $schema
     */
    protected function createDsTopicChannelTable(Schema $schema)
    {
        $table = $schema->createTable('ds_topic_channel');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->addColumn('business_unit_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('default_to', 'string', ['length' => 255]);
        $table->addColumn('created_at', 'datetime', []);
        $table->addColumn('updated_at', 'datetime', []);
        $table->addColumn('icon', 'string', ['length' => 255]);
        $table->addColumn('discriminator', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['business_unit_owner_id'], 'IDX_4253D0FB59294170', []);
        $table->addIndex(['organization_id'], 'IDX_4253D0FB32C8A3DE', []);
    }

    /**
     * Create ds_topic_channel_description table
     *
     * @param Schema $schema
     */
    protected function createDsTopicChannelDescriptionTable(Schema $schema)
    {
        $table = $schema->createTable('ds_topic_channel_description');
        $table->addColumn('channel_id', 'integer', []);
        $table->addColumn('localized_value_id', 'integer', []);
        $table->setPrimaryKey(['channel_id', 'localized_value_id']);
        $table->addUniqueIndex(['localized_value_id'], 'UNIQ_AB5E46B3EB576E89');
        $table->addIndex(['channel_id'], 'IDX_AB5E46B372F5A1AA', []);
    }

    /**
     * Create ds_topic_channel_title table
     *
     * @param Schema $schema
     */
    protected function createDsTopicChannelTitleTable(Schema $schema)
    {
        $table = $schema->createTable('ds_topic_channel_title');
        $table->addColumn('channel_id', 'integer', []);
        $table->addColumn('localized_value_id', 'integer', []);
        $table->setPrimaryKey(['channel_id', 'localized_value_id']);
        $table->addUniqueIndex(['localized_value_id'], 'UNIQ_FD08FB96EB576E89');
        $table->addIndex(['channel_id'], 'IDX_FD08FB9672F5A1AA', []);
    }

    /**
     * Create ds_topic_description table
     *
     * @param Schema $schema
     */
    protected function createDsTopicDescriptionTable(Schema $schema)
    {
        $table = $schema->createTable('ds_topic_description');
        $table->addColumn('topic_id', 'integer', []);
        $table->addColumn('localized_value_id', 'integer', []);
        $table->setPrimaryKey(['topic_id', 'localized_value_id']);
        $table->addUniqueIndex(['localized_value_id'], 'UNIQ_A88004A5EB576E89');
        $table->addIndex(['topic_id'], 'IDX_A88004A51F55203D', []);
    }

    /**
     * Create ds_topic_presentation table
     *
     * @param Schema $schema
     */
    protected function createDsTopicPresentationTable(Schema $schema)
    {
        $table = $schema->createTable('ds_topic_presentation');
        $table->addColumn('topic_id', 'integer', []);
        $table->addColumn('localized_value_id', 'integer', []);
        $table->setPrimaryKey(['topic_id', 'localized_value_id']);
        $table->addUniqueIndex(['localized_value_id'], 'UNIQ_EF125E4DEB576E89');
        $table->addIndex(['topic_id'], 'IDX_EF125E4D1F55203D', []);
    }

    /**
     * Create ds_topic_subscription table
     *
     * @param Schema $schema
     */
    protected function createDsTopicSubscriptionTable(Schema $schema)
    {
        $table = $schema->createTable('ds_topic_subscription');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('topic_id', 'integer', ['notnull' => false]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->addColumn('business_unit_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('user_id', 'integer', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime', []);
        $table->addColumn('updated_at', 'datetime', []);
        $table->addColumn('discriminator', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['user_id'], 'IDX_D7B2D20DA76ED395', []);
        $table->addIndex(['topic_id'], 'IDX_D7B2D20D1F55203D', []);
        $table->addIndex(['business_unit_owner_id'], 'IDX_D7B2D20D59294170', []);
        $table->addIndex(['organization_id'], 'IDX_D7B2D20D32C8A3DE', []);
    }

    /**
     * Create ds_topic_subscription_channel table
     *
     * @param Schema $schema
     */
    protected function createDsTopicSubscriptionChannelTable(Schema $schema)
    {
        $table = $schema->createTable('ds_topic_subscription_channel');
        $table->addColumn('subscription_id', 'integer', []);
        $table->addColumn('channel_id', 'integer', []);
        $table->setPrimaryKey(['subscription_id', 'channel_id']);
        $table->addIndex(['subscription_id'], 'IDX_1D3F79B09A1887DC', []);
        $table->addIndex(['channel_id'], 'IDX_1D3F79B072F5A1AA', []);
    }

    /**
     * Create ds_topic_title table
     *
     * @param Schema $schema
     */
    protected function createDsTopicTitleTable(Schema $schema)
    {
        $table = $schema->createTable('ds_topic_title');
        $table->addColumn('topic_id', 'integer', []);
        $table->addColumn('localized_value_id', 'integer', []);
        $table->setPrimaryKey(['topic_id', 'localized_value_id']);
        $table->addUniqueIndex(['localized_value_id'], 'UNIQ_F699C927EB576E89');
        $table->addIndex(['topic_id'], 'IDX_F699C9271F55203D', []);
    }

    /**
     * Create ds_topic_topicchannel table
     *
     * @param Schema $schema
     */
    protected function createDsTopicTopicchannelTable(Schema $schema)
    {
        $table = $schema->createTable('ds_topic_topicchannel');
        $table->addColumn('topic_id', 'integer', []);
        $table->addColumn('channel_id', 'integer', []);
        $table->setPrimaryKey(['topic_id', 'channel_id']);
        $table->addIndex(['topic_id'], 'IDX_8CB9ECC21F55203D', []);
        $table->addIndex(['channel_id'], 'IDX_8CB9ECC272F5A1AA', []);
    }

    /**
     * Add ds_topic foreign keys.
     *
     * @param Schema $schema
     */
    protected function addDsTopicForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_topic');
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
     * Add ds_topic_channel foreign keys.
     *
     * @param Schema $schema
     */
    protected function addDsTopicChannelForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_topic_channel');
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
     * Add ds_topic_channel_description foreign keys.
     *
     * @param Schema $schema
     */
    protected function addDsTopicChannelDescriptionForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_topic_channel_description');
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_topic_channel'),
            ['channel_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_fallback_localization_val'),
            ['localized_value_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }

    /**
     * Add ds_topic_channel_title foreign keys.
     *
     * @param Schema $schema
     */
    protected function addDsTopicChannelTitleForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_topic_channel_title');
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_topic_channel'),
            ['channel_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_fallback_localization_val'),
            ['localized_value_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }

    /**
     * Add ds_topic_description foreign keys.
     *
     * @param Schema $schema
     */
    protected function addDsTopicDescriptionForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_topic_description');
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_topic'),
            ['topic_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_fallback_localization_val'),
            ['localized_value_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }

    /**
     * Add ds_topic_presentation foreign keys.
     *
     * @param Schema $schema
     */
    protected function addDsTopicPresentationForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_topic_presentation');
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_topic'),
            ['topic_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_fallback_localization_val'),
            ['localized_value_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }

    /**
     * Add ds_topic_subscription foreign keys.
     *
     * @param Schema $schema
     */
    protected function addDsTopicSubscriptionForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_topic_subscription');
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_topic'),
            ['topic_id'],
            ['id'],
            ['onDelete' => null, 'onUpdate' => null]
        );
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

    /**
     * Add ds_topic_subscription_channel foreign keys.
     *
     * @param Schema $schema
     */
    protected function addDsTopicSubscriptionChannelForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_topic_subscription_channel');
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_comm_channel'),
            ['channel_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_topic_subscription'),
            ['subscription_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }

    /**
     * Add ds_topic_title foreign keys.
     *
     * @param Schema $schema
     */
    protected function addDsTopicTitleForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_topic_title');
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_topic'),
            ['topic_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_fallback_localization_val'),
            ['localized_value_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }

    /**
     * Add ds_topic_topicchannel foreign keys.
     *
     * @param Schema $schema
     */
    protected function addDsTopicTopicchannelForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_topic_topicchannel');
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_topic'),
            ['topic_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_comm_channel'),
            ['channel_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }
}
