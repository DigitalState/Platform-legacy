# DsAssetBundle

The Asset bundle provides business users the ability to manage assets. It introduces one new entity to the system: [Asset](Entity/Asset.php).

## Table of Contents

- [Asset Entity](#asset-entity)
- [Creating an Asset](#creating-an-asset)
- [Todo](#todo)

## Record Entity

Assets represent issued documents or objects, typical issued by a government or authorized third-party. For example, licenses, permits, library cards, senior's cards or animal licenses.

An Asset contains data that may be updated overtime to represent the latest version of information for the government object. A [Record](../RecordBundle/Entity/Record.php) may be issued to represent the issuing of an Asset.

## Creating an Asset

**Example**:

```php
<?php

namespace Gov\Bundle\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DemoController extends Controller
{
    public function demoAction()
    {
        $manager = $this->get('ds.asset.manager.asset');
        $asset = $manager->createEntity();
        $asset
            ->setType('dog-license')
            ->setSource('system')
            ->setData([
                'dog' => 'toby'
            ]);
        $om = $manager->getObjectManager();
        $om->persist($asset);
        $om->flush();
    }
}
```

## Todo
