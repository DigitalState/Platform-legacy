<?php

namespace Ds\Bundle\TransportBundle\Tests\Unit\Entity;

use PHPUnit_Framework_TestCase;
use Ds\Bundle\TransportBundle\Entity\Profile;
use Ds\Bundle\TransportBundle\Entity\Transport;
use DateTime;

/**
 * Class ProfileTest
 */
class ProfileTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test new instance
     */
    public function testNewInstance()
    {
        $entity = new Profile;
        $this->assertNull($entity->getId(), 'New instance property "id" is null');
        $this->assertNull($entity->getCreatedAt(), 'New instance property "createdAt" is null');
        $this->assertNull($entity->getUpdatedAt(), 'New instance property "updatedAt" is null');
        $this->assertNull($entity->getTitle(), 'New instance property "title" is null');
        $this->assertEquals([], $entity->getData(), 'New instance property "data" is empty array');
        $this->assertNull($entity->getTransport(), 'New instance property "transport" is null');
    }

    /**
     * Test accessors
     */
    public function testAccessors()
    {
        $entity = new Profile;
        $createdAt = new DateTime;
        $updatedAt = new DateTime;
        $title = 'Title test';
        $data = [ 'test' => 'test' ];
        $transport = new Transport;
        $this->assertInstanceOf('Ds\Bundle\TransportBundle\Entity\Profile', $entity->setCreatedAt($createdAt), 'A fluent interface');
        $this->assertEquals($createdAt, $entity->getCreatedAt(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\TransportBundle\Entity\Profile', $entity->setUpdatedAt($updatedAt), 'A fluent interface');
        $this->assertEquals($updatedAt, $entity->getUpdatedAt(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\TransportBundle\Entity\Profile', $entity->setTitle($title), 'A fluent interface');
        $this->assertEquals($title, $entity->getTitle(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\TransportBundle\Entity\Profile', $entity->setData($data), 'A fluent interface');
        $this->assertEquals($data, $entity->getData(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\TransportBundle\Entity\Profile', $entity->setTransport($transport), 'A fluent interface');
        $this->assertEquals($transport, $entity->getTransport(), 'Set value matches get value.');
    }
}
