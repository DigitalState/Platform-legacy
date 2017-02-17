<?php

namespace Ds\Bundle\CommunicationBundle\Entity;

use Ds\Bundle\EntityBundle\Entity\Attribute;
use Oro\Bundle\OrganizationBundle\Entity\Ownership;
use Oro\Bundle\LocaleBundle\Entity\FallbackTrait;
use Doctrine\Common\Collections\ArrayCollection;

use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Communication
 *
 * @Config(
 *      routeName="ds_communication_communication_index",
 *      routeView="ds_communication_communication_view",
 *      routeCreate="ds_communication_communication_create",
 *      routeEdit="ds_communication_communication_edit",
 *      defaultValues={
 *          "entity"={
 *              "icon"="icon-list-alt",
 *              "type"="communication",
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
 *              "default"="ds.communication.manager.communication"
 *          },
 *          "form"={
 *              "form_type"="ds_communication_communication"
 *          },
 *          "grid"={
 *              "default"="ds-communication-communication"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\CommunicationBundle\Repository\CommunicationRepository")
 * @ORM\Table(name="ds_comm")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\HasLifecycleCallbacks()
 */
class Communication
{
    use Attribute\Id;
    use Attribute\CreatedAt;
    use Attribute\UpdatedAt;
    use Attribute\Title;
    use Attribute\Description;

    use Ownership\BusinessUnitAwareTrait;

    use FallbackTrait;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="Ds\Bundle\CommunicationBundle\Entity\Content", mappedBy="communication", cascade={"persist", "remove"})
     */
    protected $contents; # region accessors

    /**
     * Add content
     *
     * @param \Ds\Bundle\CommunicationBundle\Entity\Content $content
     * @return \Ds\Bundle\CommunicationBundle\Entity\Communication
     */
    public function addContent(Content $content)
    {
        $content->setCommunication($this);
        $this->contents[] = $content;

        return $this;
    }

    /**
     * Remove content
     *
     * @param \Ds\Bundle\CommunicationBundle\Entity\Content $content
     */
    public function removeContent(Content $content)
    {
        $this->contents->removeElement($content);
    }

    /**
     * Get contents
     *
     * @return array
     */
    public function getContents()
    {
        return $this->contents->toArray();
    }

    # endregion

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="Ds\Bundle\CommunicationBundle\Entity\Criterion", mappedBy="communication", cascade={"persist", "remove"})
     */
    protected $criteria; # region accessors

    /**
     * Add criterion
     *
     * @param \Ds\Bundle\CommunicationBundle\Entity\Criterion $criterion
     * @return \Ds\Bundle\CommunicationBundle\Entity\Communication
     */
    public function addCriterion(Criterion $criterion)
    {
        $criterion->setCommunication($this);
        $this->criteria[] = $criterion;

        return $this;
    }

    /**
     * Remove criterion
     *
     * @param \Ds\Bundle\CommunicationBundle\Entity\Criterion $criterion
     */
    public function removeCriterion(Criterion $criterion)
    {
        $this->criteria->removeElement($criterion);
    }

    /**
     * Get criteria
     *
     * @return array
     */
    public function getCriteria()
    {
        return $this->criteria->toArray();
    }

    # endregion

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contents = new ArrayCollection;
        $this->criteria = new ArrayCollection;
    }
}
