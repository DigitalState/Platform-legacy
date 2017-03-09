<?php

namespace Ds\Bundle\TopicBundle\Tests\Unit\Entity;

use PHPUnit_Framework_TestCase;
use Ds\Bundle\TopicBundle\Entity\Subscription;
use Ds\Bundle\TopicBundle\Entity\Topic;
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
        $this->assertNull($entity->getTopic(), 'New instance property "topic" is null');
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
        $topic = new Topic;
        $this->assertInstanceOf('Ds\Bundle\TopicBundle\Entity\Subscription', $entity->setCreatedAt($createdAt), 'A fluent interface');
        $this->assertEquals($createdAt, $entity->getCreatedAt(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\TopicBundle\Entity\Subscription', $entity->setUpdatedAt($updatedAt), 'A fluent interface');
        $this->assertEquals($updatedAt, $entity->getUpdatedAt(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\TopicBundle\Entity\Subscription', $entity->setUser($user), 'A fluent interface');
        $this->assertEquals($user, $entity->getUser(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\TopicBundle\Entity\Subscription', $entity->setTopic($topic), 'A fluent interface');
        $this->assertEquals($topic, $entity->getTopic(), 'Set value matches get value.');
    }
}
