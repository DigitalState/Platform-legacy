<?php

namespace Ds\Bundle\ServiceBundle\Tests\Unit\Entity;

use PHPUnit_Framework_TestCase;
use Ds\Bundle\ServiceBundle\Entity\Activation;
use Ds\Bundle\ServiceBundle\Entity\Service;
use Oro\Bundle\UserBundle\Entity\User;
use DateTime;

/**
 * Class ActivationTest
 */
class ActivationTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test new instance
     */
    public function testNewInstance()
    {
        $entity = new Activation;
        $this->assertNull($entity->getId(), 'New instance property "id" is null');
        $this->assertNull($entity->getCreatedAt(), 'New instance property "createdAt" is null');
        $this->assertNull($entity->getUpdatedAt(), 'New instance property "updatedAt" is null');
        $this->assertNull($entity->getService(), 'New instance property "title" is null');
        $this->assertNull($entity->getUser(), 'New instance property "transport" is null');
    }

    /**
     * Test accessors
     */
    public function testAccessors()
    {
        $entity = new Activation;
        $createdAt = new DateTime;
        $updatedAt = new DateTime;
        $service = new Service;
        $user = new User;
        $this->assertInstanceOf('Ds\Bundle\ServiceBundle\Entity\Activation', $entity->setCreatedAt($createdAt), 'A fluent interface');
        $this->assertEquals($createdAt, $entity->getCreatedAt(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\ServiceBundle\Entity\Activation', $entity->setUpdatedAt($updatedAt), 'A fluent interface');
        $this->assertEquals($updatedAt, $entity->getUpdatedAt(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\ServiceBundle\Entity\Activation', $entity->setService($service), 'A fluent interface');
        $this->assertEquals($service, $entity->getService(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\ServiceBundle\Entity\Activation', $entity->setUser($user), 'A fluent interface');
        $this->assertEquals($user, $entity->getUser(), 'Set value matches get value.');
    }
}
