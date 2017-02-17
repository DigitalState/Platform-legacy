<?php

namespace Ds\Bundle\NotificationBundle\Entity;

use Ds\Bundle\EntityBundle\Entity\Attribute;
use Oro\Bundle\OrganizationBundle\Entity\Ownership;
use Oro\Bundle\LocaleBundle\Entity\FallbackTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Oro\Bundle\UserBundle\Entity\User;
use Ds\Bundle\CommunicationBundle\Entity\Channel;

use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Subscription
 *
 * @Config(
 *      routeName="ds_notification_subscription_index",
 *      routeView="ds_notification_subscription_view",
 *      routeCreate="ds_notification_subscription_create",
 *      routeEdit="ds_notification_subscription_edit",
 *      defaultValues={
 *          "entity"={
 *              "icon"="icon-list-alt",
 *              "type"="notification_subscription",
 *              "alias"=""
 *          },
 *          "ownership"={
 *              "owner_type"="BUSINESS_UNIT",
 *              "owner_field_name"="owner",
 *              "owner_column_name"="business_unit_owner_id",
 *              "organization_field_name"="organization",
 *              "organization_column_name"="organization_id"
 *          },
 *          "security"={
 *              "type"="ACL",
 *              "permissions"="All"
 *          },
 *          "manager"={
 *              "default"="ds.notification.manager.subscription"
 *          },
 *          "form"={
 *              "form_type"="ds_notification_subscription"
 *          },
 *          "grid"={
 *              "default"="ds-notification-subscription"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\NotificationBundle\Repository\SubscriptionRepository")
 * @ORM\Table(name="ds_notif_subscription")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\HasLifecycleCallbacks()
 */
class Subscription
{
    use Attribute\Id;
    use Attribute\CreatedAt;
    use Attribute\UpdatedAt;

    use Ownership\BusinessUnitAwareTrait;

    use FallbackTrait;

    /**
     * @var \Oro\Bundle\UserBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="Oro\Bundle\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user; # region accessors

    /**
     * Set user
     *
     * @param \Oro\Bundle\UserBundle\Entity\User $user
     * @return \Ds\Bundle\NotificationBundle\Entity\Subscription
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Oro\Bundle\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    # endregion

    /**
     * @var \Ds\Bundle\NotificationBundle\Entity\Notification
     * @ORM\ManyToOne(targetEntity="Ds\Bundle\NotificationBundle\Entity\Notification")
     * @ORM\JoinColumn(name="notification_id", referencedColumnName="id")
     */
    protected $notification; # region accessors

    /**
     * Set notification
     *
     * @param \Ds\Bundle\NotificationBundle\Entity\Notification $notification
     * @return \Ds\Bundle\NotificationBundle\Entity\Subscription
     */
    public function setNotification(Notification $notification = null)
    {
        $this->notification = $notification;

        return $this;
    }

    /**
     * Get notification
     *
     * @return \Ds\Bundle\NotificationBundle\Entity\Notification
     */
    public function getNotification()
    {
        return $this->notification;
    }

    # endregion

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\ManyToMany(targetEntity="Ds\Bundle\CommunicationBundle\Entity\Channel")
     * @ORM\JoinTable(name="ds_notif_subscription_channel")
     */
    protected $channels; # region accessors

    /**
     * Add channel
     *
     * @param \Ds\Bundle\CommunicationBundle\Entity\Channel $channel
     * @return \Ds\Bundle\NotificationBundle\Entity\Subscription
     */
    public function addChannel(Channel $channel)
    {
        $this->channels[] = $channel;

        return $this;
    }

    /**
     * Remove channel
     *
     * @param \Ds\Bundle\CommunicationBundle\Entity\Channel $channel
     */
    public function removeChannel(Channel $channel)
    {
        $this->channels->removeElement($channel);
    }

    /**
     * Get channels
     *
     * @return array
     */
    public function getChannels()
    {
        return $this->channels->toArray();
    }

    # endregion

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->channels = new ArrayCollection;
    }
}
