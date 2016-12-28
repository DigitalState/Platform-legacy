<?php

namespace Ds\Bundle\AssetBundle\Entity;

use Ds\Bundle\AssetBundle\Model\ExtendAsset;
use Ds\Bundle\EntityBundle\Entity\Attribute;
use Oro\Bundle\OrganizationBundle\Entity\Ownership;
use Ds\Bundle\CaseBundle\Entity\CaseEntity;
use Oro\Bundle\UserBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;

use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Asset
 *
 * @Config(
 *      routeName="ds_asset_asset_index",
 *      routeView="ds_asset_asset_view",
 *      routeCreate="ds_asset_asset_create",
 *      routeEdit="ds_asset_asset_edit",
 *      defaultValues={
 *          "entity"={
 *              "icon"="icon-list-alt",
 *              "type"="asset",
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
 *              "default"="ds.asset.manager.asset"
 *          },
 *          "form"={
 *              "form_type"="ds_asset_asset"
 *          },
 *          "grid"={
 *              "default"="ds-asset-asset"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\AssetBundle\Repository\AssetRepository")
 * @ORM\Table(name="ds_asset")
 * @ORM\HasLifecycleCallbacks()
 */
class Asset extends ExtendAsset
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
     *      name="ds_asset_title",
     *      joinColumns={ @ORM\JoinColumn(name="asset_id", referencedColumnName="id", onDelete="CASCADE") },
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
     * @return \Ds\Bundle\AssetBundle\Entity\Asset
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
     * @var \Ds\Bundle\CaseBundle\Entity\CaseEntity
     * @ORM\ManyToOne(targetEntity="Ds\Bundle\CaseBundle\Entity\CaseEntity")
     * @ORM\JoinColumn(name="case_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $case; # region accessors

    /**
     * Set case
     *
     * @param \Ds\Bundle\CaseBundle\Entity\CaseEntity $case
     * @return \Ds\Bundle\AssetBundle\Entity\Asset
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
