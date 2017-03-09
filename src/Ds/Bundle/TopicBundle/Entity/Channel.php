<?php

namespace Ds\Bundle\TopicBundle\Entity;

use Ds\Bundle\EntityBundle\Entity\Attribute;
use Oro\Bundle\OrganizationBundle\Entity\Ownership;
use Oro\Bundle\LocaleBundle\Entity\FallbackTrait;
use Doctrine\Common\Collections\ArrayCollection;

use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Channel
 *
 * @Config(
 *      routeName="ds_topic_channel_index",
 *      routeView="ds_topic_channel_view",
 *      routeCreate="ds_topic_channel_create",
 *      routeEdit="ds_topic_channel_edit",
 *      defaultValues={
 *          "entity"={
 *              "icon"="icon-list-alt",
 *              "type"="topic_channel",
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
 *              "default"="ds.topic.manager.channel"
 *          },
 *          "form"={
 *              "form_type"="ds_topic_channel"
 *          },
 *          "grid"={
 *              "default"="ds-topic-channel"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\TopicBundle\Repository\ChannelRepository")
 * @ORM\Table(name="ds_topic_channel")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\HasLifecycleCallbacks()
 */
class Channel
{
    use Attribute\Id;
    use Attribute\CreatedAt;
    use Attribute\UpdatedAt;
    use Attribute\Localized\Title;
    use Attribute\Localized\Description;
    use Attribute\Icon;

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
     *      name="ds_topic_channel_title",
     *      joinColumns={ @ORM\JoinColumn(name="channel_id", referencedColumnName="id", onDelete="CASCADE") },
     *      inverseJoinColumns={ @ORM\JoinColumn(name="localized_value_id", referencedColumnName="id", onDelete="CASCADE", unique=true) }
     * )
     * @ConfigField(
     *      defaultValues={
     *          "attribute"={
     *              "is_attribute"=true
     *          }
     *      }
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
     *      name="ds_topic_channel_description",
     *      joinColumns={ @ORM\JoinColumn(name="channel_id", referencedColumnName="id", onDelete="CASCADE") },
     *      inverseJoinColumns={ @ORM\JoinColumn(name="localized_value_id", referencedColumnName="id", onDelete="CASCADE", unique=true) }
     * )
     */
    protected $descriptions;

    /**
     * @var string
     * @ORM\Column(name="default_to", type="string", length=255)
     * @Assert\NotBlank(message="ds.topic.channel.default_to.not_blank")
     * @Assert\Length(min=1, max=255, minMessage="ds.topic.channel.default_to.min", maxMessage="ds.topic.channel.default_to.length.max")
     */
    protected $defaultTo; # region accessors

    /**
     * Set default to
     *
     * @param string $defaultTo
     * @return \Ds\Bundle\TopicBundle\Entity\Channel
     */
    public function setDefaultTo($defaultTo)
    {
        $this->defaultTo = $defaultTo;

        return $this;
    }

    /**
     * Get default to
     *
     * @return string
     */
    public function getDefaultTo()
    {
        return $this->defaultTo;
    }

    # endregion

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->titles = new ArrayCollection;
        $this->descriptions = new ArrayCollection;
    }
}
