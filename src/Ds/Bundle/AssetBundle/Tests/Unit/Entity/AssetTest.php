<?php

namespace Ds\Bundle\AssetBundle\Tests\Unit\Entity;

use PHPUnit_Framework_TestCase;
use Ds\Bundle\AssetBundle\Entity\Asset;
use Doctrine\Common\Collections\ArrayCollection;
use DateTime;

/**
 * Class AssetTest
 */
class AssetTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test new instance
     */
    public function testNewInstance()
    {
        $entity = new Asset;
        $this->assertNull($entity->getId(), 'New instance property "id" is null');
        $this->assertNull($entity->getCreatedAt(), 'New instance property "createdAt" is null');
        $this->assertNull($entity->getUpdatedAt(), 'New instance property "updatedAt" is null');
        $this->assertEquals(new ArrayCollection, $entity->getTitles(), 'New instance property "titles" is empty collection');
        $this->assertNull($entity->getType(), 'New instance property "slug" is null');
        $this->assertNull($entity->getSource(), 'New instance property "description" is null');
        $this->assertEquals([], $entity->getData(), 'New instance property "data" is empty array');
    }

    /**
     * Test accessors
     */
    public function testAccessors()
    {
        $entity = new Asset;
        $createdAt = new DateTime;
        $updatedAt = new DateTime;
        $titles = new ArrayCollection;
        $type = 'Type test';
        $source = 'Source test';
        $data = [ 'test' => 'test' ];
        $this->assertInstanceOf('Ds\Bundle\AssetBundle\Entity\Asset', $entity->setCreatedAt($createdAt), 'A fluent interface');
        $this->assertEquals($createdAt, $entity->getCreatedAt(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\AssetBundle\Entity\Asset', $entity->setUpdatedAt($updatedAt), 'A fluent interface');
        $this->assertEquals($updatedAt, $entity->getUpdatedAt(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\AssetBundle\Entity\Asset', $entity->setTitles($titles), 'A fluent interface');
        $this->assertEquals($titles, $entity->getTitles(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\AssetBundle\Entity\Asset', $entity->setType($type), 'A fluent interface');
        $this->assertEquals($type, $entity->getType(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\AssetBundle\Entity\Asset', $entity->setSource($source), 'A fluent interface');
        $this->assertEquals($source, $entity->getSource(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\AssetBundle\Entity\Asset', $entity->setData($data), 'A fluent interface');
        $this->assertEquals($data, $entity->getData(), 'Set value matches get value.');
    }
}
