<?php

namespace Ds\Bundle\NotificationBundle\Tests\Unit\Entity;

use PHPUnit_Framework_TestCase;
use Ds\Bundle\NotificationBundle\Entity\Subscription;
use Ds\Bundle\NotificationBundle\Entity\Notification;
use Oro\Bundle\UserBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use DateTime;

/**
 * Class SubscriptionTest
 */
class SubscriptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test new instance
     */
    public function testNewInstance()
    {
        $entity = new Subscription;
        $this->assertNull($entity->getId(), 'New instance property "id" is null');
        $this->assertNull($entity->getCreatedAt(), 'New instance property "createdAt" is null');
        $this->assertNull($entity->getUpdatedAt(), 'New instance property "updatedAt" is null');
        $this->assertNull($entity->getUser(), 'New instance property "user" is null');
        $this->assertNull($entity->getNotification(), 'New instance property "notification" is null');
    }

    /**
     * Test accessors
     */
    public function testAccessors()
    {
        $entity = new Subscription;
        $createdAt = new DateTime;
        $updatedAt = new DateTime;
        $user = new User;
        $notification = new Notification;
        $this->assertInstanceOf('Ds\Bundle\NotificationBundle\Entity\Subscription', $entity->setCreatedAt($createdAt), 'A fluent interface');
        $this->assertEquals($createdAt, $entity->getCreatedAt(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\NotificationBundle\Entity\Subscription', $entity->setUpdatedAt($updatedAt), 'A fluent interface');
        $this->assertEquals($updatedAt, $entity->getUpdatedAt(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\NotificationBundle\Entity\Subscription', $entity->setUser($user), 'A fluent interface');
        $this->assertEquals($user, $entity->getUser(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\NotificationBundle\Entity\Subscription', $entity->setNotification($notification), 'A fluent interface');
        $this->assertEquals($notification, $entity->getNotification(), 'Set value matches get value.');
    }
}
