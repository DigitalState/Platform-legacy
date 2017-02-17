<?php

namespace Ds\Bundle\CommunicationBundle\Entity;

use Ds\Bundle\EntityBundle\Entity\Attribute;
use Oro\Bundle\OrganizationBundle\Entity\Ownership;
use Oro\Bundle\LocaleBundle\Entity\FallbackTrait;

use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Template
 *
 * @Config(
 *      routeName="ds_communication_template_index",
 *      routeView="ds_communication_template_view",
 *      routeCreate="ds_communication_template_create",
 *      routeEdit="ds_communication_template_edit",
 *      defaultValues={
 *          "entity"={
 *              "icon"="icon-list-alt",
 *              "type"="communication_template",
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
 *              "default"="ds.communication.manager.template"
 *          },
 *          "form"={
 *              "form_type"="ds_communication_template"
 *          },
 *          "grid"={
 *              "default"="ds-communication-template"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\CommunicationBundle\Repository\TemplateRepository")
 * @ORM\Table(name="ds_comm_template")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\HasLifecycleCallbacks()
 */
class Template
{
    use Attribute\Id;
    use Attribute\CreatedAt;
    use Attribute\UpdatedAt;
    use Attribute\Title;
    use Attribute\Presentation;

    use Ownership\BusinessUnitAwareTrait;

    use FallbackTrait;
}
