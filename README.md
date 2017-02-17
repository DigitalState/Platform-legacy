# DsOrganizationBundle

The Organization bundle extends the OroOrganizationBundle and provides the developers additional core organization functionality. 

[![Code Climate](https://codeclimate.com/github/DigitalState/Platform-Organization-Bundle/badges/gpa.svg)](https://codeclimate.com/github/DigitalState/Platform-Organization-Bundle)
[![Test Coverage](https://codeclimate.com/github/DigitalState/Platform-Organization-Bundle/badges/coverage.svg)](https://codeclimate.com/github/DigitalState/Platform-Organization-Bundle/coverage)


## Table of Contents

- [Migration Extensions](#migration-extensions)
- [Todo](#todo)

## Migration Extensions

This bundle introduces a collection of convenient [migration extensions](Migration/Extension) to help with loading yml-based data fixtures.

**Example**:

```php
<?php

namespace Gov\Bundle\DemoBundle\Migrations\Data\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Ds\Bundle\OrganizationBundle\Migration\Extension\BusinessUnitExtensionAwareInterface;
use Ds\Bundle\OrganizationBundle\Migration\Extension\BusinessUnitExtensionAwareTrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Doctrine\Common\Persistence\ObjectManager;

class LoadBusinessUnitData extends AbstractFixture implements BusinessUnitExtensionAwareInterface, ContainerAwareInterface
{
    use BusinessUnitExtensionAwareTrait;
    use ContainerAwareTrait;

    public function load(ObjectManager $manager)
    {
        // Currently extensions are not automatically injected via the *AwareInterface.
        $this->setBusinessUnitExtension($this->container->get('ds.organization.migration.extension.business_unit'));
        //
        
        $resource = __DIR__.'/../../../Resources/data/business_unit.yml';
        $this->businessUnitExtension->import($resource, $manager);
    }
}
```

```yml
business_units:
    -
        name: Public Works
    -
        name: Finance
    -
        name: Human Resources

prototype:
    name: ~
    phone: ~
    website: ~
    email: ~
    fax: ~
    organization: default
    parent: ~
```

## Todo

