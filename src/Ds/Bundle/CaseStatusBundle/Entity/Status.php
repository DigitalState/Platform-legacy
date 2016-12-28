<?php

namespace Ds\Bundle\CaseStatusBundle\Entity;

use Ds\Bundle\EntityBundle\Entity\Attribute;
use Oro\Bundle\OrganizationBundle\Entity\Ownership;
use Ds\Bundle\CaseBundle\Entity\CaseEntity;
use Doctrine\Common\Collections\ArrayCollection;

use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Status
 *
 * @Config(
 *      routeName="ds_casestatus_status_index",
 *      routeView="ds_casestatus_status_view",
 *      routeCreate="ds_casestatus_status_create",
 *      routeEdit="ds_casestatus_status_edit",
 *      defaultValues={
 *          "entity"={
 *              "icon"="icon-list-alt",
 *              "type"="case_status",
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
 *              "default"="ds.casestatus.manager.status"
 *          },
 *          "form"={
 *              "form_type"="ds_casestatus_status"
 *          },
 *          "grid"={
 *              "default"="ds-casestatus-status"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\CaseStatusBundle\Repository\StatusRepository")
 * @ORM\Table(name="ds_case_status")
 * @ORM\HasLifecycleCallbacks()
 */
class Status
{
    use Attribute\Id;
    use Attribute\CreatedAt;
    use Attribute\UpdatedAt;
    use Attribute\Localized\Title;
    use Attribute\Source;
    use Attribute\Type;
    use Attribute\Localized\Description;
    use Attribute\Percentage;
    use Attribute\Data;

    use Ownership\BusinessUnitAwareTrait;

    /**
     * @var \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue[]
     * @ORM\ManyToMany(
     *      targetEntity="Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue",
     *      cascade={"ALL"},
     *      orphanRemoval=true
     * )
     * @ORM\JoinTable(
     *      name="ds_case_status_title",
     *      joinColumns={ @ORM\JoinColumn(name="status_id", referencedColumnName="id", onDelete="CASCADE") },
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
     *      name="ds_case_status_description",
     *      joinColumns={ @ORM\JoinColumn(name="status_id", referencedColumnName="id", onDelete="CASCADE") },
     *      inverseJoinColumns={ @ORM\JoinColumn(name="localized_value_id", referencedColumnName="id", onDelete="CASCADE", unique=true) }
     * )
     */
    protected $descriptions;

    /**
     * @var \Ds\Bundle\CaseBundle\Entity\CaseEntity
     * @ORM\ManyToOne(targetEntity="Ds\Bundle\CaseBundle\Entity\CaseEntity")
     * @ORM\JoinColumn(name="case_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $case; # region accessors

    /**
     * Set case
     *
     * @param \Ds\Bundle\CaseBundle\Entity\CaseEntity $case
     * @return \Ds\Bundle\CaseStatusBundle\Entity\Status
     */
    public function setCase(CaseEntity $case = null)
    {
        $this->case = $case;

        return $this;
    }

    /**
     * Get case
     *
     * @return \Ds\Bundle\CaseBundle\Entity\CaseEntity
     */
    public function getCase()
    {
        return $this->case;
    }

    # endregion

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->titles = new ArrayCollection;
        $this->descriptions = new ArrayCollection;
        $this->percentage = 0;
        $this->data = [];
    }
}
