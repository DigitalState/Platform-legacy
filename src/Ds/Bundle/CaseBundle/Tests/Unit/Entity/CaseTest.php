<?php

namespace Ds\Bundle\CaseBundle\Tests\Unit\Entity;

use PHPUnit_Framework_TestCase;
use Ds\Bundle\CaseBundle\Entity\CaseEntity;
use Doctrine\Common\Collections\ArrayCollection;
use DateTime;

/**
 * Class CaseTest
 */
class CaseTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test new instance
     */
    public function testNewInstance()
    {
        $entity = new CaseEntity;
        $this->assertNull($entity->getId(), 'New instance property "id" is null');
        $this->assertNull($entity->getCreatedAt(), 'New instance property "createdAt" is null');
        $this->assertNull($entity->getUpdatedAt(), 'New instance property "updatedAt" is null');
        $this->assertEquals(new ArrayCollection, $entity->getTitles(), 'New instance property "titles" is empty collection');
        $this->assertNull($entity->getSource(), 'New instance property "source" is null');
        $this->assertNull($entity->getState(), 'New instance property "source" is null');
        $this->assertNull($entity->getStatus(), 'New instance property "source" is null');
    }

    /**
     * Test accessors
     */
    public function testAccessors()
    {
        $entity = new CaseEntity;
        $createdAt = new DateTime;
        $updatedAt = new DateTime;
        $titles = new ArrayCollection;
        $source = 'Source test';
        $this->assertInstanceOf('Ds\Bundle\CaseBundle\Entity\CaseEntity', $entity->setCreatedAt($createdAt), 'A fluent interface');
        $this->assertEquals($createdAt, $entity->getCreatedAt(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\CaseBundle\Entity\CaseEntity', $entity->setUpdatedAt($updatedAt), 'A fluent interface');
        $this->assertEquals($updatedAt, $entity->getUpdatedAt(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\CaseBundle\Entity\CaseEntity', $entity->setTitles($titles), 'A fluent interface');
        $this->assertEquals($titles, $entity->getTitles(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\CaseBundle\Entity\CaseEntity', $entity->setSource($source), 'A fluent interface');
        $this->assertEquals($source, $entity->getSource(), 'Set value matches get value.');
    }
}
