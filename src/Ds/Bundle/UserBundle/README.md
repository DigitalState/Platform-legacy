# Platform-User-Bundle

The User bundle extends the OroUserBundle and provides the developers additional core user functionality. 

[![Code Climate](https://codeclimate.com/github/DigitalState/Platform-User-Bundle/badges/gpa.svg)](https://codeclimate.com/github/DigitalState/Platform-User-Bundle)
[![Test Coverage](https://codeclimate.com/github/DigitalState/Platform-User-Bundle/badges/coverage.svg)](https://codeclimate.com/github/DigitalState/Platform-User-Bundle/coverage)

## Table of Contents

- [Data Resolvers](#data-resolvers)
- [Migration Extensions](#migration-extensions)
- [Todo](#todo)

## Data Resolvers

This bundle introduces another type of [data resolver](https://github.com/DigitalState/Platform-Data-Bundle) based on current session data, instead of the database.

**Example**:

```php
<?php

namespace Gov\Bundle\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DemoController extends Controller
{
    public function demoAction()
    {
        $data = $this->get('ds.data.data');
        $username = $data->resolve('ds.session.user.username');
    }
}
```

A typical use case would be when you wish to pre-populate a form with session data.

**Example**:

```php
<?php

namespace Gov\Bundle\DemoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class DemoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text', [
            'data' => 'ds.session.user.username',
            'resolve' => true
        ]);
    }
}
```

## Migration Extensions

This bundle introduces a collection of convenient [migration extensions](Migration/Extension) to help with loading yml-based data fixtures.

**Example**:

```php
<?php

namespace Gov\Bundle\DemoBundle\Migrations\Data\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Ds\Bundle\UserBundle\Migration\Extension\UserExtensionAwareInterface;
use Ds\Bundle\UserBundle\Migration\Extension\UserExtensionAwareTrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData extends AbstractFixture implements UserExtensionAwareInterface, ContainerAwareInterface
{
    use UserExtensionAwareTrait;
    use ContainerAwareTrait;

    public function load(ObjectManager $manager)
    {
        // Currently extensions are not automatically injected via the *AwareInterface.
        $this->setUserExtension($this->container->get('ds.user.migration.extension.user'));
        //
        
        $resource = __DIR__.'/../../../Resources/data/users.yml';
        $this->userExtension->import($resource, $manager);
    }
}
```

```yml
users:
    -
        username: john
        password: john
        email: john@gov.com
        roles: [ ROLE_USER ]
        first_name: John
        last_name: Doe

prototype:
    email: ~
    roles: []
    first_name: ~
    last_name: ~
    owner: main
    business_units: [ main ]
    organization: default
    organizations: [ default ]
    enabled: true
```

## Todo
