<?php

namespace Ds\Bundle\CommunicationBundle\Tests\Unit\Entity;

use PHPUnit_Framework_TestCase;
use Ds\Bundle\CommunicationBundle\Entity\Content;
use DateTime;

/**
 * Class ContentTest
 */
class ContentTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test new instance
     */
    public function testNewInstance()
    {
        $entity = new Content;
        $this->assertNull($entity->getId(), 'New instance property "id" is null');
        $this->assertNull($entity->getCreatedAt(), 'New instance property "createdAt" is null');
        $this->assertNull($entity->getUpdatedAt(), 'New instance property "updatedAt" is null');
    }

    /**
     * Test accessors
     */
    public function testAccessors()
    {
        $entity = new Content;
        $createdAt = new DateTime;
        $updatedAt = new DateTime;
        $this->assertInstanceOf('Ds\Bundle\CommunicationBundle\Entity\Content', $entity->setCreatedAt($createdAt), 'A fluent interface');
        $this->assertEquals($createdAt, $entity->getCreatedAt(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\CommunicationBundle\Entity\Content', $entity->setUpdatedAt($updatedAt), 'A fluent interface');
        $this->assertEquals($updatedAt, $entity->getUpdatedAt(), 'Set value matches get value.');
    }
}
