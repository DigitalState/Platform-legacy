<?php

namespace Ds\Bundle\NotificationBundle\Tests\Unit\Entity;

use PHPUnit_Framework_TestCase;
use Ds\Bundle\NotificationBundle\Entity\Notification;
use Doctrine\Common\Collections\ArrayCollection;
use DateTime;

/**
 * Class NotificationTest
 */
class NotificationTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test new instance
     */
    public function testNewInstance()
    {
        $entity = new Notification;
        $titles = new ArrayCollection;
        $descriptions = new ArrayCollection;
        $presentations = new ArrayCollection;
        $this->assertNull($entity->getId(), 'New instance property "id" is null');
        $this->assertNull($entity->getCreatedAt(), 'New instance property "createdAt" is null');
        $this->assertNull($entity->getUpdatedAt(), 'New instance property "updatedAt" is null');
        $this->assertEquals($titles, $entity->getTitles(), 'New instance property "titles" is empty collection');
        $this->assertNull($entity->getSlug(), 'New instance property "slug" is null');
        $this->assertEquals($descriptions, $entity->getDescriptions(), 'New instance property "descriptions" is empty collection');
        $this->assertNull($entity->getIcon(), 'New instance property "icon" is null');
        $this->assertEquals($presentations, $entity->getPresentations(), 'New instance property "presentations" is empty collection');
    }

    /**
     * Test accessors
     */
    public function testAccessors()
    {
        $entity = new Notification;
        $createdAt = new DateTime;
        $updatedAt = new DateTime;
        $titles = new ArrayCollection;
        $slug = 'Slug test';
        $descriptions = new ArrayCollection;
        $icon = 'Icon test';
        $presentations = new ArrayCollection;
        $this->assertInstanceOf('Ds\Bundle\NotificationBundle\Entity\Notification', $entity->setCreatedAt($createdAt), 'A fluent interface');
        $this->assertEquals($createdAt, $entity->getCreatedAt(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\NotificationBundle\Entity\Notification', $entity->setUpdatedAt($updatedAt), 'A fluent interface');
        $this->assertEquals($updatedAt, $entity->getUpdatedAt(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\NotificationBundle\Entity\Notification', $entity->setTitles($titles), 'A fluent interface');
        $this->assertEquals($titles, $entity->getTitles(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\NotificationBundle\Entity\Notification', $entity->setSlug($slug), 'A fluent interface');
        $this->assertEquals($slug, $entity->getSlug(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\NotificationBundle\Entity\Notification', $entity->setDescriptions($descriptions), 'A fluent interface');
        $this->assertEquals($descriptions, $entity->getDescriptions(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\NotificationBundle\Entity\Notification', $entity->setIcon($icon), 'A fluent interface');
        $this->assertEquals($icon, $entity->getIcon(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\NotificationBundle\Entity\Notification', $entity->setPresentations($presentations), 'A fluent interface');
        $this->assertEquals($presentations, $entity->getPresentations(), 'Set value matches get value.');
    }
}
