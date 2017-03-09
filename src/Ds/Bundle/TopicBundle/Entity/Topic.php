<?php

namespace Ds\Bundle\TopicBundle\Entity;

use Ds\Bundle\EntityBundle\Entity\Attribute;
use Oro\Bundle\OrganizationBundle\Entity\Ownership;
use Oro\Bundle\LocaleBundle\Entity\FallbackTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Ds\Bundle\CommunicationBundle\Entity\Channel;

use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Topic
 *
 * @Config(
 *      routeName="ds_topic_topic_index",
 *      routeView="ds_topic_topic_view",
 *      routeCreate="ds_topic_topic_create",
 *      routeEdit="ds_topic_topic_edit",
 *      defaultValues={
 *          "entity"={
 *              "icon"="icon-list-alt",
 *              "type"="topic",
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
 *              "default"="ds.topic.manager.topic"
 *          },
 *          "form"={
 *              "form_type"="ds_topic_topic"
 *          },
 *          "grid"={
 *              "default"="ds-topic-topic"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\TopicBundle\Repository\TopicRepository")
 * @ORM\Table(name="ds_topic")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\HasLifecycleCallbacks()
 * @ORMAssert\UniqueEntity(fields="slug", message="The slug must be unique.")
 */
class Topic
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

    use FallbackTrait;

    /**
     * @var \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue[]
     * @ORM\ManyToMany(
     *      targetEntity="Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue",
     *      cascade={"ALL"},
     *      orphanRemoval=true
     * )
     * @ORM\JoinTable(
     *      name="ds_topic_title",
     *      joinColumns={ @ORM\JoinColumn(name="topic_id", referencedColumnName="id", onDelete="CASCADE") },
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
     *      name="ds_topic_description",
     *      joinColumns={ @ORM\JoinColumn(name="topic_id", referencedColumnName="id", onDelete="CASCADE") },
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
     *      name="ds_topic_presentation",
     *      joinColumns={ @ORM\JoinColumn(name="topic_id", referencedColumnName="id", onDelete="CASCADE") },
     *      inverseJoinColumns={ @ORM\JoinColumn(name="localized_value_id", referencedColumnName="id", onDelete="CASCADE", unique=true) }
     * )
     */
    protected $presentations;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\ManyToMany(targetEntity="Ds\Bundle\CommunicationBundle\Entity\Channel")
     * @ORM\JoinTable(name="ds_topic_topicchannel")
     */
    protected $channels; # region accessors

    /**
     * Add channel
     *
     * @param \Ds\Bundle\TopicBundle\Entity\Channel $channel
     * @return \Ds\Bundle\TopicBundle\Entity\Topic
     */
    public function addChannel(Channel $channel)
    {
        $this->channels[] = $channel;

        return $this;
    }

    /**
     * Remove channel
     *
     * @param \Ds\Bundle\TopicBundle\Entity\Channel $channel
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
