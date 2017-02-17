# Platform-Security-Bundle

The Security bundle extends the [OroSecurityBundle](https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/SecurityBundle) and provides the developers additional core security functionality. 

[![Code Climate](https://codeclimate.com/github/DigitalState/Platform-Security-Bundle/badges/gpa.svg)](https://codeclimate.com/github/DigitalState/Platform-Security-Bundle)
[![Test Coverage](https://codeclimate.com/github/DigitalState/Platform-Security-Bundle/badges/coverage.svg)](https://codeclimate.com/github/DigitalState/Platform-Security-Bundle/coverage)

## Table of Contents

- [Migration Extensions](#migration-extensions)
- [Todo](#todo)

## Migration Extensions

This bundle introduces a convenient [migration extension](Migration/Extension) to help with loading yml-based acl data fixtures.

**Example**:

```php
<?php

namespace Gov\Bundle\DemoBundle\Migrations\Data\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Ds\Bundle\UserBundle\Migration\Extension\AclExtensionAwareInterface;
use Ds\Bundle\UserBundle\Migration\Extension\AclExtensionAwareTrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Doctrine\Common\Persistence\ObjectManager;

class LoadAclData extends AbstractFixture implements AclExtensionAwareInterface, ContainerAwareInterface
{
    use AclExtensionAwareTrait;
    use ContainerAwareTrait;

    public function load(ObjectManager $manager)
    {
        // Currently extensions are not automatically injected via the *AwareInterface.
        $this->setAclExtension($this->container->get('ds.security.migration.extension.acl'));
        //
        
        $resource = __DIR__.'/../../../Resources/data/acl.yml';
        $this->aclExtension->import($resource, $manager);
    }
}
```

```yml
acl:
    ROLE_CASE_MANAGER:
        Entity:DsCaseBundle:CaseEntity: [ VIEW_SYSTEM, CREATE_SYSTEM, EDIT_SYSTEM, DELETE_SYSTEM, ASSIGN_SYSTEM ]
        Entity:DsCaseStatusBundle:Status: [ VIEW_SYSTEM, CREATE_SYSTEM, EDIT_SYSTEM, DELETE_SYSTEM, ASSIGN_SYSTEM ]
```

## Todo
