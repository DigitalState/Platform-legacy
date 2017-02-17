<?php

namespace Ds\Bundle\NotificationBundle\Migrations\Schema\v0_1_0;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * Class DsNotificationBundle
 */
class DsNotificationBundle implements Migration
{
    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $this->createNotificationTable($schema);
        $this->createNotificationChannelTable($schema);
        $this->createNotificationDescriptionTable($schema);
        $this->createNotificationPresentationTable($schema);
        $this->createNotificationTitleTable($schema);
        $this->createNotificationSubscriptionTable($schema);
        $this->createNotificationSubscriptionChannelTable($schema);
        $this->addNotificationForeignKeys($schema);
        $this->addNotificationChannelForeignKeys($schema);
        $this->addNotificationDescriptionForeignKeys($schema);
        $this->addNotificationPresentationForeignKeys($schema);
        $this->addNotificationTitleForeignKeys($schema);
        $this->addNotificationSubscriptionForeignKeys($schema);
        $this->addNotificationSubscriptionChannelForeignKeys($schema);
    }

    /**
     * Create notification table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createNotificationTable(Schema $schema)
    {
        $table = $schema->createTable('ds_notif');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->addColumn('business_unit_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime', []);
        $table->addColumn('updated_at', 'datetime', []);
        $table->addColumn('slug', 'string', ['length' => 255]);
        $table->addColumn('icon', 'string', ['length' => 255]);
        $table->addColumn('discriminator', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
        $table->addUniqueIndex(['slug'], 'UNIQ_63E4E718989D9B62');
        $table->addIndex(['business_unit_owner_id'], 'IDX_63E4E71859294170', []);
        $table->addIndex(['organization_id'], 'IDX_63E4E71832C8A3DE', []);
    }

    /**
     * Create notification channel table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createNotificationChannelTable(Schema $schema)
    {
        $table = $schema->createTable('ds_notif_channel');
        $table->addColumn('notification_id', 'integer', []);
        $table->addColumn('channel_id', 'integer', []);
        $table->setPrimaryKey(['notification_id', 'channel_id']);
        $table->addIndex(['notification_id'], 'IDX_ECAF8934EF1A9D84', []);
        $table->addIndex(['channel_id'], 'IDX_ECAF893472F5A1AA', []);
    }

    /**
     * Create notification description table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createNotificationDescriptionTable(Schema $schema)
    {
        $table = $schema->createTable('ds_notif_description');
        $table->addColumn('notification_id', 'integer', []);
        $table->addColumn('localized_value_id', 'integer', []);
        $table->setPrimaryKey(['notification_id', 'localized_value_id']);
        $table->addUniqueIndex(['localized_value_id'], 'UNIQ_D7D76133EB576E89');
        $table->addIndex(['notification_id'], 'IDX_D7D76133ED5CA9E6', []);
    }

    /**
     * Create notification presentation table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createNotificationPresentationTable(Schema $schema)
    {
        $table = $schema->createTable('ds_notif_presentation');
        $table->addColumn('notification_id', 'integer', []);
        $table->addColumn('localized_value_id', 'integer', []);
        $table->setPrimaryKey(['notification_id', 'localized_value_id']);
        $table->addUniqueIndex(['localized_value_id'], 'UNIQ_F6013F59EB576E89');
        $table->addIndex(['notification_id'], 'IDX_F6013F59ED5CA9E6', []);
    }

    /**
     * Create notification title table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createNotificationTitleTable(Schema $schema)
    {
        $table = $schema->createTable('ds_notif_title');
        $table->addColumn('notification_id', 'integer', []);
        $table->addColumn('localized_value_id', 'integer', []);
        $table->setPrimaryKey(['notification_id', 'localized_value_id']);
        $table->addUniqueIndex(['localized_value_id'], 'UNIQ_357C7684EB576E89');
        $table->addIndex(['notification_id'], 'IDX_357C7684ED5CA9E6', []);
    }

    /**
     * Create notification subscription table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createNotificationSubscriptionTable(Schema $schema)
    {
        $table = $schema->createTable('ds_notif_subscription');
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->addColumn('business_unit_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('user_id', 'integer', ['notnull' => false]);
        $table->addColumn('notification_id', 'integer', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime', []);
        $table->addColumn('updated_at', 'datetime', []);
        $table->addColumn('discriminator', 'string', ['length' => 255]);
        $table->setPrimaryKey(['id']);
        $table->addIndex(['user_id'], 'IDX_86A8F6FCA76ED395', []);
        $table->addIndex(['notification_id'], 'IDX_86A8F6FCEF1A9D84', []);
        $table->addIndex(['business_unit_owner_id'], 'IDX_86A8F6FC59294170', []);
        $table->addIndex(['organization_id'], 'IDX_86A8F6FC32C8A3DE', []);
    }

    /**
     * Create notification subscription channel table
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function createNotificationSubscriptionChannelTable(Schema $schema)
    {
        $table = $schema->createTable('ds_notif_subscription_channel');
        $table->addColumn('subscription_id', 'integer', []);
        $table->addColumn('channel_id', 'integer', []);
        $table->setPrimaryKey(['subscription_id', 'channel_id']);
        $table->addIndex(['subscription_id'], 'IDX_B232B76D9A1887DC', []);
        $table->addIndex(['channel_id'], 'IDX_B232B76D72F5A1AA', []);
    }

    /**
     * Add notification foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addNotificationForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_notif');
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
     * Add notification channel foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addNotificationChannelForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_notif_channel');
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_comm_channel'),
            ['channel_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_notif'),
            ['notification_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }

    /**
     * Add notification description foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addNotificationDescriptionForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_notif_description');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_fallback_localization_val'),
            ['localized_value_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_notif'),
            ['notification_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }

    /**
     * Add notification presentation foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addNotificationPresentationForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_notif_presentation');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_fallback_localization_val'),
            ['localized_value_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_notif'),
            ['notification_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }

    /**
     * Add notification title foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addNotificationTitleForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_notif_title');
        $table->addForeignKeyConstraint(
            $schema->getTable('oro_fallback_localization_val'),
            ['localized_value_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_notif'),
            ['notification_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }

    /**
     * Add notification subscription foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addNotificationSubscriptionForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_notif_subscription');
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
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_notif'),
            ['notification_id'],
            ['id'],
            ['onDelete' => null, 'onUpdate' => null]
        );
    }

    /**
     * Add notification subscription channel foreign keys.
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    protected function addNotificationSubscriptionChannelForeignKeys(Schema $schema)
    {
        $table = $schema->getTable('ds_notif_subscription_channel');
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_comm_channel'),
            ['channel_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
        $table->addForeignKeyConstraint(
            $schema->getTable('ds_notif_subscription'),
            ['subscription_id'],
            ['id'],
            ['onDelete' => 'CASCADE', 'onUpdate' => null]
        );
    }
}
