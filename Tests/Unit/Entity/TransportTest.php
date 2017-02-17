<?php

namespace Ds\Bundle\TransportBundle\Tests\Unit\Entity;

use PHPUnit_Framework_TestCase;
use Ds\Bundle\TransportBundle\Entity\Transport;
use DateTime;

/**
 * Class TransportTest
 */
class TransportTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test new instance
     */
    public function testNewInstance()
    {
        $entity = new Transport;
        $this->assertNull($entity->getId(), 'New instance property "id" is null');
        $this->assertNull($entity->getCreatedAt(), 'New instance property "createdAt" is null');
        $this->assertNull($entity->getUpdatedAt(), 'New instance property "updatedAt" is null');
        $this->assertNull($entity->getTitle(), 'New instance property "title" is null');
        $this->assertNull($entity->getImplementation(), 'New instance property "implementation" is null');
        $this->assertEquals([], $entity->getData(), 'New instance property "data" is empty array');
    }

    /**
     * Test accessors
     */
    public function testAccessors()
    {
        $entity = new Transport;
        $createdAt = new DateTime;
        $updatedAt = new DateTime;
        $title = 'Title test';
        $implementation = 'Implementation test';
        $data = [ 'test' => 'test' ];
        $this->assertInstanceOf('Ds\Bundle\TransportBundle\Entity\Transport', $entity->setCreatedAt($createdAt), 'A fluent interface');
        $this->assertEquals($createdAt, $entity->getCreatedAt(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\TransportBundle\Entity\Transport', $entity->setUpdatedAt($updatedAt), 'A fluent interface');
        $this->assertEquals($updatedAt, $entity->getUpdatedAt(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\TransportBundle\Entity\Transport', $entity->setTitle($title), 'A fluent interface');
        $this->assertEquals($title, $entity->getTitle(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\TransportBundle\Entity\Transport', $entity->setImplementation($implementation), 'A fluent interface');
        $this->assertEquals($implementation, $entity->getImplementation(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\TransportBundle\Entity\Transport', $entity->setData($data), 'A fluent interface');
        $this->assertEquals($data, $entity->getData(), 'Set value matches get value.');
    }
}
