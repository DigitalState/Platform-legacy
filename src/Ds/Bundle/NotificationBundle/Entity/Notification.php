<?php

namespace Ds\Bundle\NotificationBundle\Entity;

use Ds\Bundle\EntityBundle\Entity\Attribute;
use Oro\Bundle\OrganizationBundle\Entity\Ownership;
use Doctrine\Common\Collections\ArrayCollection;
use Ds\Bundle\CommunicationBundle\Entity\Channel;

use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Notification
 *
 * @Config(
 *      routeName="ds_notification_notification_index",
 *      routeView="ds_notification_notification_view",
 *      routeCreate="ds_notification_notification_create",
 *      routeEdit="ds_notification_notification_edit",
 *      defaultValues={
 *          "entity"={
 *              "icon"="icon-list-alt",
 *              "type"="notification",
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
 *              "default"="ds.notification.manager.notification"
 *          },
 *          "form"={
 *              "form_type"="ds_notification_notification"
 *          },
 *          "grid"={
 *              "default"="ds-notification-notification"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\NotificationBundle\Repository\NotificationRepository")
 * @ORM\Table(name="ds_notif")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\HasLifecycleCallbacks()
 * @ORMAssert\UniqueEntity(fields="slug", message="The slug must be unique.")
 */
class Notification
{
    use Attribute\Id;
    use Attribute\CreatedAt;
    use Attribute\UpdatedAt;
    use Attribute\Localized\Title;
    use Attribute\Slug;
    use Attribute\Localized\Description;
    use Attribute\Icon;
    use Attribute\Localized\Presentation;

    use Ownership\BusinessUnitAwareTrait;

    /**
     * @var \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue[]
     * @ORM\ManyToMany(
     *      targetEntity="Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue",
     *      cascade={"ALL"},
     *      orphanRemoval=true
     * )
     * @ORM\JoinTable(
     *      name="ds_notif_title",
     *      joinColumns={ @ORM\JoinColumn(name="notification_id", referencedColumnName="id", onDelete="CASCADE") },
     *      inverseJoinColumns={ @ORM\JoinColumn(name="localized_value_id", referencedColumnName="id", onDelete="CASCADE", unique=true) }
     * )
     */
    protected $titles;

    /**
     * @var \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue[]
     * @ORM\ManyToMany(
     *      targetEntity="Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue",
     *      cascade={"ALL"},
     *      orphanRemoval=true
     * )
     * @ORM\JoinTable(
     *      name="ds_notif_description",
     *      joinColumns={ @ORM\JoinColumn(name="notification_id", referencedColumnName="id", onDelete="CASCADE") },
     *      inverseJoinColumns={ @ORM\JoinColumn(name="localized_value_id", referencedColumnName="id", onDelete="CASCADE", unique=true) }
     * )
     */
    protected $descriptions;

    /**
     * @var \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue[]
     * @ORM\ManyToMany(
     *      targetEntity="Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue",
     *      cascade={"ALL"},
     *      orphanRemoval=true
     * )
     * @ORM\JoinTable(
     *      name="ds_notif_presentation",
     *      joinColumns={ @ORM\JoinColumn(name="notification_id", referencedColumnName="id", onDelete="CASCADE") },
     *      inverseJoinColumns={ @ORM\JoinColumn(name="localized_value_id", referencedColumnName="id", onDelete="CASCADE", unique=true) }
     * )
     */
    protected $presentations;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\ManyToMany(targetEntity="Ds\Bundle\CommunicationBundle\Entity\Channel")
     * @ORM\JoinTable(name="ds_notif_channel")
     */
    protected $channels; # region accessors

    /**
     * Add channel
     *
     * @param \Ds\Bundle\CommunicationBundle\Entity\Channel $channel
     * @return \Ds\Bundle\NotificationBundle\Entity\Notification
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
        $this->titles = new ArrayCollection;
        $this->descriptions = new ArrayCollection;
        $this->presentations = new ArrayCollection;
        $this->channels = new ArrayCollection;
    }
}
