<?php

namespace Ds\Bundle\TopicBundle\Entity;

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
 *      routeName="ds_topic_subscription_index",
 *      routeView="ds_topic_subscription_view",
 *      routeCreate="ds_topic_subscription_create",
 *      routeEdit="ds_topic_subscription_edit",
 *      defaultValues={
 *          "entity"={
 *              "icon"="icon-list-alt",
 *              "type"="topic_subscription",
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
 *              "default"="ds.topic.manager.subscription"
 *          },
 *          "form"={
 *              "form_type"="ds_topic_subscription"
 *          },
 *          "grid"={
 *              "default"="ds-topic-subscription"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\TopicBundle\Repository\SubscriptionRepository")
 * @ORM\Table(name="ds_topic_subscription")
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
     * @return \Ds\Bundle\TopicBundle\Entity\Subscription
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
     * @var \Ds\Bundle\TopicBundle\Entity\Topic
     * @ORM\ManyToOne(targetEntity="Ds\Bundle\TopicBundle\Entity\Topic")
     * @ORM\JoinColumn(name="topic_id", referencedColumnName="id")
     */
    protected $topic; # region accessors

    /**
     * Set topic
     *
     * @param \Ds\Bundle\TopicBundle\Entity\Topic $topic
     * @return \Ds\Bundle\TopicBundle\Entity\Subscription
     */
    public function setTopic(Topic $topic = null)
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * Get topic
     *
     * @return \Ds\Bundle\TopicBundle\Entity\Topic
     */
    public function getTopic()
    {
        return $this->topic;
    }

    # endregion

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\ManyToMany(targetEntity="Ds\Bundle\CommunicationBundle\Entity\Channel")
     * @ORM\JoinTable(name="ds_topic_subscription_channel")
     */
    protected $channels; # region accessors

    /**
     * Add channel
     *
     * @param \Ds\Bundle\CommunicationBundle\Entity\Channel $channel
     * @return \Ds\Bundle\TopicBundle\Entity\Subscription
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
