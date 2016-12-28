<?php

namespace Ds\Bundle\UserPersonaBundle\Entity;

use Ds\Bundle\EntityBundle\Entity\Attribute;
use Oro\Bundle\OrganizationBundle\Entity\Ownership;
use Oro\Bundle\UserBundle\Entity\User;

use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Persona
 *
 * @Config(
 *      routeName="ds_userpersona_persona_index",
 *      routeView="ds_userpersona_persona_view",
 *      routeCreate="ds_userpersona_persona_create",
 *      routeEdit="ds_userpersona_persona_edit",
 *      defaultValues={
 *          "entity"={
 *              "icon"="icon-list-alt",
 *              "type"="persona",
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
 *              "default"="ds.userpersona.manager.persona"
 *          },
 *          "form"={
 *              "form_type"="ds_userpersona_persona"
 *          },
 *          "grid"={
 *              "default"="ds-userpersona-persona"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\UserPersonaBundle\Repository\PersonaRepository")
 * @ORM\Table(name="ds_user_persona")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\HasLifecycleCallbacks()
 */
class Persona
{
    use Attribute\Id;
    use Attribute\CreatedAt;
    use Attribute\UpdatedAt;
    use Attribute\Data;

    use Ownership\BusinessUnitAwareTrait;

    /**
     * @var \Ds\Bundle\UserPersonaBundle\Entity\Definition
     * @ORM\ManyToOne(targetEntity="Ds\Bundle\UserPersonaBundle\Entity\Definition")
     * @ORM\JoinColumn(name="definition_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $definition; # region accessors

    /**
     * Set definition
     *
     * @param \Ds\Bundle\UserPersonaBundle\Entity\Definition $definition
     * @return \Ds\Bundle\UserPersonaBundle\Entity\Persona
     */
    public function setDefinition(Definition $definition = null)
    {
        $this->definition = $definition;

        return $this;
    }

    /**
     * Get definition
     *
     * @return \Ds\Bundle\UserPersonaBundle\Entity\Definition
     */
    public function getDefinition()
    {
        return $this->definition;
    }

    # endregion

    /**
     * @var \Oro\Bundle\UserBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="Oro\Bundle\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $user; # region accessors

    /**
     * Set user
     *
     * @param \Oro\Bundle\UserBundle\Entity\User $user
     * @return \Ds\Bundle\UserPersonaBundle\Entity\Persona
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
     * Constructor
     */
    public function __construct()
    {
        $this->data = [];
    }
}
