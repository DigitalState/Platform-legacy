<?php

namespace Ds\Bundle\CommunicationBundle\Entity;

use Ds\Bundle\EntityBundle\Entity\Attribute;
use Oro\Bundle\OrganizationBundle\Entity\Ownership;
use Oro\Bundle\LocaleBundle\Entity\FallbackTrait;
use Oro\Bundle\UserBundle\Entity\User;

use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Message
 *
 * @Config(
 *      routeName="ds_communication_message_index",
 *      routeView="ds_communication_message_view",
 *      routeCreate="ds_communication_message_create",
 *      routeEdit="ds_communication_message_edit",
 *      defaultValues={
 *          "entity"={
 *              "icon"="icon-list-alt",
 *              "type"="communication_message",
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
 *              "default"="ds.communication.manager.message"
 *          },
 *          "form"={
 *              "form_type"="ds_communication_message"
 *          },
 *          "grid"={
 *              "default"="ds-communication-message"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\CommunicationBundle\Repository\MessageRepository")
 * @ORM\Table(name="ds_comm_message")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\HasLifecycleCallbacks()
 */
class Message
{
    use Attribute\Id;
    use Attribute\CreatedAt;
    use Attribute\UpdatedAt;
    use Attribute\Title;
    use Attribute\Presentation;
    use Attribute\SentAt;

    use Ownership\BusinessUnitAwareTrait;

    use FallbackTrait;

    /**
     * @var \Ds\Bundle\CommunicationBundle\Entity\Communication
     * @ORM\ManyToOne(targetEntity="Ds\Bundle\CommunicationBundle\Entity\Communication")
     * @ORM\JoinColumn(name="communication_id", referencedColumnName="id")
     */
    protected $communication; # region accessors

    /**
     * Set communication
     *
     * @param \Ds\Bundle\CommunicationBundle\Entity\Communication $communication
     * @return \Ds\Bundle\CommunicationBundle\Entity\Message
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
     * @var \Oro\Bundle\UserBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="Oro\Bundle\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user; # region accessors

    /**
     * Set user
     *
     * @param \Oro\Bundle\UserBundle\Entity\User $user
     * @return \Ds\Bundle\NotificationBundle\Entity\Message
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
     * @var \Ds\Bundle\CommunicationBundle\Entity\Channel
     * @ORM\ManyToOne(targetEntity="Ds\Bundle\CommunicationBundle\Entity\Channel")
     * @ORM\JoinColumn(name="channel_id", referencedColumnName="id")
     */
    protected $channel; # region accessors

    /**
     * Set channel
     *
     * @param \Ds\Bundle\CommunicationBundle\Entity\Channel $channel
     * @return \Ds\Bundle\CommunicationBundle\Entity\Message
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
}
