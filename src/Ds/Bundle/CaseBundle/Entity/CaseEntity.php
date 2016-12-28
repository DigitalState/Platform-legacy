<?php

namespace Ds\Bundle\CaseBundle\Entity;

use Ds\Bundle\EntityBundle\Entity\Attribute;
use Oro\Bundle\OrganizationBundle\Entity\Ownership;
use Oro\Bundle\UserBundle\Entity\User;
use Ds\Bundle\ServiceBundle\Entity\Service;
use Ds\Bundle\RecordBundle\Entity\Record;
use Doctrine\Common\Collections\ArrayCollection;

use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CaseEntity
 *
 * @Config(
 *      routeName="ds_case_case_index",
 *      routeView="ds_case_case_view",
 *      routeCreate="ds_case_case_create",
 *      routeEdit="ds_case_case_edit",
 *      defaultValues={
 *          "entity"={
 *              "icon"="icon-list-alt",
 *              "type"="case",
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
 *              "default"="ds.case.manager.case"
 *          },
 *          "form"={
 *              "form_type"="ds_case_case"
 *          },
 *          "grid"={
 *              "default"="ds-case-case"
 *          },
 *          "note"={
 *              "enabled"=true
 *          },
 *          "asset"={
 *              "enabled"=true
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\CaseBundle\Repository\CaseRepository")
 * @ORM\Table(name="ds_case")
 * @ORM\HasLifecycleCallbacks()
 */
class CaseEntity
{
    use Attribute\Id;
    use Attribute\CreatedAt;
    use Attribute\UpdatedAt;
    use Attribute\Localized\Title;
    use Attribute\Source;
    use Attribute\State;
    use Attribute\Status;

    use Ownership\BusinessUnitAwareTrait;

    /**
     * @var \Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue[]
     * @ORM\ManyToMany(
     *      targetEntity="Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue",
     *      cascade={"ALL"},
     *      orphanRemoval=true
     * )
     * @ORM\JoinTable(
     *      name="ds_case_title",
     *      joinColumns={ @ORM\JoinColumn(name="case_id", referencedColumnName="id", onDelete="CASCADE") },
     *      inverseJoinColumns={ @ORM\JoinColumn(name="localized_value_id", referencedColumnName="id", onDelete="CASCADE", unique=true) }
     * )
     */
    protected $titles;

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
     * @return \Ds\Bundle\CaseBundle\Entity\CaseEntity
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
     * @var \Ds\Bundle\ServiceBundle\Entity\Service
     * @ORM\ManyToOne(targetEntity="Ds\Bundle\ServiceBundle\Entity\Service")
     * @ORM\JoinColumn(name="service_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $service; # region accessors

    /**
     * Set service
     *
     * @param \Ds\Bundle\ServiceBundle\Entity\Service $service
     * @return \Ds\Bundle\CaseBundle\Entity\CaseEntity
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
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="Ds\Bundle\RecordBundle\Entity\Record", mappedBy="case")
     */
    protected $records; # region accessors

    /**
     * Add record
     *
     * @param \Ds\Bundle\RecordBundle\Entity\Record $record
     * @return \Ds\Bundle\CaseBundle\Entity\CaseEntity
     */
    public function addRecord(Record $record)
    {
        $record->setCase($this);
        $this->records[] = $record;

        return $this;
    }

    /**
     * Remove record
     *
     * @param \Ds\Bundle\RecordBundle\Entity\Record $record
     */
    public function removeRecord(Record $record)
    {
        $this->records->removeElement($record);
    }

    /**
     * Get records
     *
     * @return array
     */
    public function getRecords()
    {
        return $this->records->toArray();
    }

    # endregion

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->titles = new ArrayCollection;
        $this->records = new ArrayCollection;
    }
}
