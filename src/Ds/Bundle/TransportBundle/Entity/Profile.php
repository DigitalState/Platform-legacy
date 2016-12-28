<?php

namespace Ds\Bundle\TransportBundle\Entity;

use Ds\Bundle\EntityBundle\Entity\Attribute;
use Oro\Bundle\OrganizationBundle\Entity\Ownership;

use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Profile
 *
 * @Config(
 *      routeName="ds_transport_profile_index",
 *      routeView="ds_transport_profile_view",
 *      routeCreate="ds_transport_profile_create",
 *      routeEdit="ds_transport_profile_edit",
 *      defaultValues={
 *          "entity"={
 *              "icon"="icon-list-alt",
 *              "type"="profile",
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
 *              "default"="ds.transport.manager.profile"
 *          },
 *          "form"={
 *              "form_type"="ds_transport_profile"
 *          },
 *          "grid"={
 *              "default"="ds-transport-profile"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\TransportBundle\Repository\ProfileRepository")
 * @ORM\Table(name="ds_transport_profile")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\HasLifecycleCallbacks()
 */
class Profile
{
    use Attribute\Id;
    use Attribute\CreatedAt;
    use Attribute\UpdatedAt;
    use Attribute\Title;
    use Attribute\Data;

    use Ownership\BusinessUnitAwareTrait;

    /**
     * @var \Ds\Bundle\TransportBundle\Entity\Transport
     * @ORM\ManyToOne(targetEntity="Ds\Bundle\TransportBundle\Entity\Transport")
     * @ORM\JoinColumn(name="transport_id", referencedColumnName="id")
     */
    protected $transport; # region accessors

    /**
     * Set transport
     *
     * @param \Ds\Bundle\TransportBundle\Entity\Transport $transport
     * @return \Ds\Bundle\TransportBundle\Entity\Profile
     */
    public function setTransport(Transport $transport = null)
    {
        $this->transport = $transport;

        return $this;
    }

    /**
     * Get transport
     *
     * @return \Ds\Bundle\TransportBundle\Entity\Transport
     */
    public function getTransport()
    {
        return $this->transport;
    }

    # endregion

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->data = [];
    }
}
