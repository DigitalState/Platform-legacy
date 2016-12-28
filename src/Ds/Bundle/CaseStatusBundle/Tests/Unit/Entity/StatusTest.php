<?php

namespace Ds\Bundle\CaseStatusBundle\Tests\Unit\Entity;

use PHPUnit_Framework_TestCase;
use Ds\Bundle\CaseStatusBundle\Entity\Status;
use Doctrine\Common\Collections\ArrayCollection;
use DateTime;

/**
 * Class StatusTest
 */
class StatusTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test new instance
     */
    public function testNewInstance()
    {
        $entity = new Status;
        $this->assertNull($entity->getId(), 'New instance property "id" is null');
        $this->assertNull($entity->getCreatedAt(), 'New instance property "createdAt" is null');
        $this->assertNull($entity->getUpdatedAt(), 'New instance property "updatedAt" is null');
        $this->assertEquals(new ArrayCollection, $entity->getTitles(), 'New instance property "titles" is empty collection');
        $this->assertNull($entity->getSource(), 'New instance property "source" is null');
        $this->assertNull($entity->getType(), 'New instance property "type" is null');
        $this->assertEquals(new ArrayCollection, $entity->getDescriptions(), 'New instance property "descriptions" is empty collection');
        $this->assertEquals(0, $entity->getPercentage(), 'New instance property "percentage" is zero');
        $this->assertEquals([], $entity->getData(), 'New instance property "data" is empty array');
    }

    /**
     * Test accessors
     */
    public function testAccessors()
    {
        $entity = new Status;
        $createdAt = new DateTime;
        $updatedAt = new DateTime;
        $titles = new ArrayCollection;
        $source = 'Source test';
        $type = 'Type test';
        $descriptions = new ArrayCollection;
        $percentage = 100;
        $data = [];
        $this->assertInstanceOf('Ds\Bundle\CaseStatusBundle\Entity\Status', $entity->setCreatedAt($createdAt), 'A fluent interface');
        $this->assertEquals($createdAt, $entity->getCreatedAt(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\CaseStatusBundle\Entity\Status', $entity->setUpdatedAt($updatedAt), 'A fluent interface');
        $this->assertEquals($updatedAt, $entity->getUpdatedAt(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\CaseStatusBundle\Entity\Status', $entity->setTitles($titles), 'A fluent interface');
        $this->assertEquals($titles, $entity->getTitles(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\CaseStatusBundle\Entity\Status', $entity->setSource($source), 'A fluent interface');
        $this->assertEquals($source, $entity->getSource(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\CaseStatusBundle\Entity\Status', $entity->setType($type), 'A fluent interface');
        $this->assertEquals($type, $entity->getType(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\CaseStatusBundle\Entity\Status', $entity->setDescriptions($descriptions), 'A fluent interface');
        $this->assertEquals($descriptions, $entity->getDescriptions(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\CaseStatusBundle\Entity\Status', $entity->setPercentage($percentage), 'A fluent interface');
        $this->assertEquals($percentage, $entity->getPercentage(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\CaseStatusBundle\Entity\Status', $entity->setData($data), 'A fluent interface');
        $this->assertEquals($data, $entity->getData(), 'Set value matches get value.');
    }
}
