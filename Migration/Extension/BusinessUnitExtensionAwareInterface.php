<?php

namespace Ds\Bundle\OrganizationBundle\Migration\Extension;

/**
 * Interface BusinessUnitExtensionAwareInterface
 */
interface BusinessUnitExtensionAwareInterface
{
    /**
     * Sets the business unit extension
     *
     * @param \Ds\Bundle\OrganizationBundle\Migration\Extension\BusinessUnitExtension $businessUnitExtension
     */
    public function setBusinessUnitExtension(BusinessUnitExtension $businessUnitExtension);
}
