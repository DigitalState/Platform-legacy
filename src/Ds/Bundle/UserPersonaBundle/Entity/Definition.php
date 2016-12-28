<?php

namespace Ds\Bundle\UserPersonaBundle\Entity;

use Ds\Bundle\EntityBundle\Entity\Attribute;
use Oro\Bundle\OrganizationBundle\Entity\Ownership;

use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Definition
 *
 * @Config(
 *      routeName="ds_userpersona_definition_index",
 *      routeView="ds_userpersona_definition_view",
 *      routeCreate="ds_userpersona_definition_create",
 *      routeEdit="ds_userpersona_definition_edit",
 *      defaultValues={
 *          "entity"={
 *              "icon"="icon-list-alt",
 *              "type"="persona_definition",
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
 *              "default"="ds.userpersona.manager.definition"
 *          },
 *          "form"={
 *              "form_type"="ds_userpersona_definition"
 *          },
 *          "grid"={
 *              "default"="ds-userpersona-definition"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\UserPersonaBundle\Repository\DefinitionRepository")
 * @ORM\Table(name="ds_user_persona_definition")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\HasLifecycleCallbacks()
 * @ORMAssert\UniqueEntity(fields="slug", message="The slug must be unique.")
 */
class Definition
{
    use Attribute\Id;
    use Attribute\CreatedAt;
    use Attribute\UpdatedAt;
    use Attribute\Title;
    use Attribute\Slug;
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
