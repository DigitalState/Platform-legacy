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
 * Class Criterion
 *
 * @Config(
 *      routeName="ds_communication_criterion_index",
 *      routeView="ds_communication_criterion_view",
 *      routeCreate="ds_communication_criterion_create",
 *      routeEdit="ds_communication_criterion_edit",
 *      defaultValues={
 *          "entity"={
 *              "icon"="icon-list-alt",
 *              "type"="communication_criterion",
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
 *              "default"="ds.communication.manager.criterion"
 *          },
 *          "form"={
 *              "form_type"="ds_communication_criterion"
 *          },
 *          "grid"={
 *              "default"="ds-communication-criterion"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\CommunicationBundle\Repository\CriterionRepository")
 * @ORM\Table(name="ds_comm_criterion")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\HasLifecycleCallbacks()
 */
class Criterion
{
    use Attribute\Id;
    use Attribute\CreatedAt;
    use Attribute\UpdatedAt;
    use Attribute\Implementation;

    use Ownership\BusinessUnitAwareTrait;

    use FallbackTrait;

    /**
     * @var \Ds\Bundle\CommunicationBundle\Entity\Communication
     * @ORM\ManyToOne(targetEntity="Ds\Bundle\CommunicationBundle\Entity\Communication", inversedBy="criteria")
     * @ORM\JoinColumn(name="communication_id", referencedColumnName="id")
     */
    protected $communication; # region accessors

    /**
     * Set communication
     *
     * @param \Ds\Bundle\CommunicationBundle\Entity\Communication $communication
     * @return \Ds\Bundle\CommunicationBundle\Entity\Criterion
     */
    public function setCommunication(Communication $communication = null)
    {
        $this->communication = $communication;

        return $this;
    }

    /**
     * Get communication
     *
     * @return \Ds\Bundle\CommunicationBundle\Entity\Communication
     */
    public function getCommunication()
    {
        return $this->communication;
    }

    # endregion

    /**
     * @var string
     * @ORM\Column(name="operand_1", type="string", length=255)
     * @Assert\NotBlank(message="ds.communication.criterion.operand_1.not_blank")
     * @Assert\Length(min=1, max=255, minMessage="ds.communication.criterion.operand_1.length.min", maxMessage="ds.communication.criterion.operand_1.length.max")
     */
    protected $operand1; # region accessors

    /**
     * Set operand 1
     *
     * @param string $operand1
     * @return \Ds\Bundle\CommunicationBundle\Entity\Criterion
     */
    public function setOperand1($operand1)
    {
        $this->operand1 = $operand1;

        return $this;
    }

    /**
     * Get operand 1
     *
     * @return string
     */
    public function getOperand1()
    {
        return $this->operand1;
    }

    # endregion

    /**
     * @var string
     * @ORM\Column(name="`operator`", type="string", length=255)
     * @Assert\NotBlank(message="ds.communication.criterion.operator.not_blank")
     */
    protected $operator; # region accessors

    /**
     * Set operator
     *
     * @param string $operator
     * @return \Ds\Bundle\CommunicationBundle\Entity\Criterion
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;

        return $this;
    }

    /**
     * Get operator
     *
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    # endregion

    /**
     * @var string
     * @ORM\Column(name="operand_2", type="string", length=255)
     * @Assert\NotBlank(message="ds.communication.criterion.operand_2.not_blank")
     * @Assert\Length(min=1, max=255, minMessage="ds.communication.criterion.operand_2.length.min", maxMessage="ds.communication.criterion.operand_2.length.max")
     */
    protected $operand2; # region accessors

    /**
     * Set operand 2
     *
     * @param string $operand2
     * @return \Ds\Bundle\CommunicationBundle\Entity\Criterion
     */
    public function setOperand2($operand2)
    {
        $this->operand2 = $operand2;

        return $this;
    }

    /**
     * Get operand 2
     *
     * @return string
     */
    public function getOperand2()
    {
        return $this->operand2;
    }

    # endregion
}
