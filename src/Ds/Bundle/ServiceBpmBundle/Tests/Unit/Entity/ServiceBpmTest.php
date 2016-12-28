<?php

namespace Ds\Bundle\ServiceBpmBundle\Tests\Unit\Entity;

use PHPUnit_Framework_TestCase;
use Ds\Bundle\ServiceBpmBundle\Entity\ServiceBpm;

/**
 * Class ServiceBpmTest
 */
class ServiceBpmTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test new instance
     */
    public function testNewInstance()
    {
        $entity = new ServiceBpm;
        $this->assertNull($entity->getBpm(), 'New instance property "bpm" is null');
        $this->assertNull($entity->getBpmId(), 'New instance property "bpmId" is null');
    }

    /**
     * Test accessors
     */
    public function testAccessors()
    {
        $entity = new ServiceBpm;
        $bpm = 'Bpm test';
        $bpmId = 'BpmId test';
        $this->assertInstanceOf('Ds\Bundle\ServiceBpmBundle\Entity\ServiceBpm', $entity->setBpm($bpm), 'A fluent interface');
        $this->assertEquals($bpm, $entity->getBpm(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\ServiceBpmBundle\Entity\ServiceBpm', $entity->setBpmId($bpmId), 'A fluent interface');
        $this->assertEquals($bpmId, $entity->getBpmId(), 'Set value matches get value.');
    }
}
