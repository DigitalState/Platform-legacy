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
 * Class Transport
 *
 * @Config(
 *      routeName="ds_transport_transport_index",
 *      routeView="ds_transport_transport_view",
 *      routeCreate="ds_transport_transport_create",
 *      routeEdit="ds_transport_transport_edit",
 *      defaultValues={
 *          "entity"={
 *              "icon"="icon-list-alt",
 *              "type"="transport",
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
 *              "default"="ds.transport.manager.transport"
 *          },
 *          "form"={
 *              "form_type"="ds_transport_transport"
 *          },
 *          "grid"={
 *              "default"="ds-transport-transport"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\TransportBundle\Repository\TransportRepository")
 * @ORM\Table(name="ds_transport")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\HasLifecycleCallbacks()
 */
class Transport
{
    use Attribute\Id;
    use Attribute\CreatedAt;
    use Attribute\UpdatedAt;
    use Attribute\Title;
    use Attribute\Implementation;
    use Attribute\Data;

    use Ownership\BusinessUnitAwareTrait;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->data = [];
    }
}
