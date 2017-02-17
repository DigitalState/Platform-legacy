<?php

namespace Ds\Bundle\CommunicationBundle\Tests\Unit\Entity;

use PHPUnit_Framework_TestCase;
use Ds\Bundle\CommunicationBundle\Entity\Channel;
use Doctrine\Common\Collections\ArrayCollection;
use DateTime;

/**
 * Class ChannelTest
 */
class ChannelTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test new instance
     */
    public function testNewInstance()
    {
        $entity = new Channel;
        $titles = new ArrayCollection;
        $this->assertNull($entity->getId(), 'New instance property "id" is null');
        $this->assertNull($entity->getCreatedAt(), 'New instance property "createdAt" is null');
        $this->assertNull($entity->getUpdatedAt(), 'New instance property "updatedAt" is null');
        $this->assertEquals($titles, $entity->getTitles(), 'New instance property "titles" is empty collection');
    }

    /**
     * Test accessors
     */
    public function testAccessors()
    {
        $entity = new Channel;
        $createdAt = new DateTime;
        $updatedAt = new DateTime;
        $titles = new ArrayCollection;
        $this->assertInstanceOf('Ds\Bundle\CommunicationBundle\Entity\Channel', $entity->setCreatedAt($createdAt), 'A fluent interface');
        $this->assertEquals($createdAt, $entity->getCreatedAt(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\CommunicationBundle\Entity\Channel', $entity->setUpdatedAt($updatedAt), 'A fluent interface');
        $this->assertEquals($updatedAt, $entity->getUpdatedAt(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\CommunicationBundle\Entity\Channel', $entity->setTitles($titles), 'A fluent interface');
        $this->assertEquals($titles, $entity->getTitles(), 'Set value matches get value.');
    }
}
