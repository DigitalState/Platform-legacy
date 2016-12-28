<?php

namespace Ds\Bundle\OrganizationBundle\Migration\Extension;

/**
 * Trait BusinessUnitExtensionAwareTrait
 */
trait BusinessUnitExtensionAwareTrait
{
    /**
     * @var \Ds\Bundle\OrganizationBundle\Migration\Extension\BusinessUnitExtension
     */
    protected $businessUnitExtension;

    /**
     * Sets the business unit extension
     *
     * @param \Ds\Bundle\OrganizationBundle\Migration\Extension\BusinessUnitExtension $businessUnitExtension
     */
    public function setBusinessUnitExtension(BusinessUnitExtension $businessUnitExtension)
    {
        $this->businessUnitExtension = $businessUnitExtension;
    }
}
