<?php

namespace Ds\Bundle\CommunicationBundle\Entity;

use Ds\Bundle\EntityBundle\Entity\Attribute;
use Oro\Bundle\OrganizationBundle\Entity\Ownership;
use Oro\Bundle\LocaleBundle\Entity\FallbackTrait;
use Ds\Bundle\TransportBundle\Entity\Profile;

use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Content
 *
 * @Config(
 *      routeName="ds_communication_content_index",
 *      routeView="ds_communication_content_view",
 *      routeCreate="ds_communication_content_create",
 *      routeEdit="ds_communication_content_edit",
 *      defaultValues={
 *          "entity"={
 *              "icon"="icon-list-alt",
 *              "type"="communication_content",
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
 *              "default"="ds.communication.manager.content"
 *          },
 *          "form"={
 *              "form_type"="ds_communication_content"
 *          },
 *          "grid"={
 *              "default"="ds-communication-content"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\CommunicationBundle\Repository\ContentRepository")
 * @ORM\Table(name="ds_comm_content")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\HasLifecycleCallbacks()
 */
class Content
{
    use Attribute\Id;
    use Attribute\CreatedAt;
    use Attribute\UpdatedAt;
    use Attribute\Title;
    use Attribute\Presentation;

    use Ownership\BusinessUnitAwareTrait;

    use FallbackTrait;

    /**
     * @var \Ds\Bundle\CommunicationBundle\Entity\Communication
     * @ORM\ManyToOne(targetEntity="Ds\Bundle\CommunicationBundle\Entity\Communication", inversedBy="contents")
     * @ORM\JoinColumn(name="communication_id", referencedColumnName="id")
     */
    protected $communication; # region accessors

    /**
     * Set communication
     *
     * @param \Ds\Bundle\CommunicationBundle\Entity\Communication $communication
     * @return \Ds\Bundle\CommunicationBundle\Entity\Content
     */
    public function setCommunication(Communication $communication = null)
    {
        $this->communication = $communication;

        return $this;
    }

    /**
     * Get communication
     *
     * @return \Ds\Bundle\CommunicationBundle\Entity\Communication
     */
    public function getCommunication()
    {
        return $this->communication;
    }

    # endregion

    /**
     * @var \Ds\Bundle\CommunicationBundle\Entity\Channel
     * @ORM\ManyToOne(targetEntity="Ds\Bundle\CommunicationBundle\Entity\Channel")
     * @ORM\JoinColumn(name="channel_id", referencedColumnName="id")
     */
    protected $channel; # region accessors

    /**
     * Set channel
     *
     * @param \Ds\Bundle\CommunicationBundle\Entity\Channel $channel
     * @return \Ds\Bundle\CommunicationBundle\Entity\Content
     */
    public function setChannel(Channel $channel = null)
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * Get channel
     *
     * @return \Ds\Bundle\CommunicationBundle\Entity\Channel
     */
    public function getChannel()
    {
        return $this->channel;
    }

    # endregion

    /**
     * @var \Ds\Bundle\TransportBundle\Entity\Profile
     * @ORM\ManyToOne(targetEntity="Ds\Bundle\TransportBundle\Entity\Profile")
     * @ORM\JoinColumn(name="profile_id", referencedColumnName="id")
     */
    protected $profile; # region accessors

    /**
     * Set profile
     *
     * @param \Ds\Bundle\TransportBundle\Entity\Profile $profile
     * @return \Ds\Bundle\CommunicationBundle\Entity\Content
     */
    public function setProfile(Profile $profile = null)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get profile
     *
     * @return \Ds\Bundle\TransportBundle\Entity\Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }

    # endregion

    /**
     * @var \Ds\Bundle\CommunicationBundle\Entity\Template
     * @ORM\ManyToOne(targetEntity="Ds\Bundle\CommunicationBundle\Entity\Template")
     * @ORM\JoinColumn(name="template_id", referencedColumnName="id")
     */
    protected $template; # region accessors

    /**
     * Set template
     *
     * @param \Ds\Bundle\CommunicationBundle\Entity\Template $template
     * @return \Ds\Bundle\CommunicationBundle\Entity\Content
     */
    public function setTemplate(Template $template = null)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Get template
     *
     * @return \Ds\Bundle\CommunicationBundle\Entity\Template
     */
    public function getTemplate()
    {
        return $this->template;
    }

    # endregion
}
