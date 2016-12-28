<?php

namespace Ds\Bundle\ServiceBundle\Entity;

use Ds\Bundle\EntityBundle\Entity\Attribute;
use Oro\Bundle\OrganizationBundle\Entity\Ownership;
use Oro\Bundle\UserBundle\Entity\User;

use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Activation
 *
 * @Config(
 *      routeName="ds_service_activation_index",
 *      routeView="ds_service_activation_view",
 *      routeCreate="ds_service_activation_create",
 *      routeEdit="ds_service_activation_edit",
 *      defaultValues={
 *          "entity"={
 *              "icon"="icon-list-alt",
 *              "type"="activation",
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
 *              "default"="ds.service.manager.activation"
 *          },
 *          "form"={
 *              "form_type"="ds_service_activation"
 *          },
 *          "grid"={
 *              "default"="ds-service-activation"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\ServiceBundle\Repository\ActivationRepository")
 * @ORM\Table(name="ds_service_activation")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\HasLifecycleCallbacks()
 */
class Activation
{
    use Attribute\Id;
    use Attribute\CreatedAt;
    use Attribute\UpdatedAt;

    use Ownership\BusinessUnitAwareTrait;

    /**
     * @var \Ds\Bundle\ServiceBundle\Entity\Service
     * @ORM\ManyToOne(targetEntity="Ds\Bundle\ServiceBundle\Entity\Service")
     * @ORM\JoinColumn(name="service_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $service; # region accessors

    /**
     * Set service
     *
     * @param \Ds\Bundle\ServiceBundle\Entity\Service $service
     * @return \Ds\Bundle\ServiceBundle\Entity\Activation
     */
    public function setService(Service $service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \Ds\Bundle\ServiceBundle\Entity\Service
     */
    public function getService()
    {
        return $this->service;
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
     * @return \Ds\Bundle\ServiceBundle\Entity\Activation
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
}
