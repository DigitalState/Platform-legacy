<?php

namespace Ds\Bundle\RecordBundle\Entity;

use Ds\Bundle\RecordBundle\Model\ExtendRecord;
use Ds\Bundle\EntityBundle\Entity\Attribute;
use Oro\Bundle\OrganizationBundle\Entity\Ownership;
use Doctrine\Common\Collections\ArrayCollection;
use Ds\Bundle\CaseBundle\Entity\CaseEntity;

use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Record
 *
 * @Config(
 *      routeName="ds_record_record_index",
 *      routeView="ds_record_record_view",
 *      routeCreate="ds_record_record_create",
 *      routeEdit="ds_record_record_edit",
 *      defaultValues={
 *          "entity"={
 *              "icon"="icon-list-alt",
 *              "type"="record",
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
 *              "default"="ds.record.manager.record"
 *          },
 *          "form"={
 *              "form_type"="ds_record_record"
 *          },
 *          "grid"={
 *              "default"="ds-record-record"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\RecordBundle\Repository\RecordRepository")
 * @ORM\Table(name="ds_record")
 * @ORM\HasLifecycleCallbacks()
 */
class Record extends ExtendRecord
{
    use Attribute\Id;
    use Attribute\CreatedAt;
    use Attribute\UpdatedAt;
    use Attribute\Localized\Title;
    use Attribute\Type;
    use Attribute\Source;
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
     *      name="ds_record_title",
     *      joinColumns={ @ORM\JoinColumn(name="record_id", referencedColumnName="id", onDelete="CASCADE") },
     *      inverseJoinColumns={ @ORM\JoinColumn(name="localized_value_id", referencedColumnName="id", onDelete="CASCADE", unique=true) }
     * )
     */
    protected $titles;

    /**
     * @var \Ds\Bundle\CaseBundle\Entity\CaseEntity
     * @ORM\ManyToOne(targetEntity="Ds\Bundle\CaseBundle\Entity\CaseEntity", inversedBy="records")
     * @ORM\JoinColumn(name="case_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $case; # region accessors

    /**
     * Set case
     *
     * @param \Ds\Bundle\CaseBundle\Entity\CaseEntity $case
     * @return \Ds\Bundle\RecordBundle\Entity\Record
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
        parent::__construct();

        $this->titles = new ArrayCollection;
        $this->data = [];
    }
}
