<?php

namespace Ds\Bundle\ServiceUrlBundle\Tests\Unit\Entity;

use PHPUnit_Framework_TestCase;
use Ds\Bundle\ServiceUrlBundle\Entity\ServiceUrl;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class ServiceUrlTest
 */
class ServiceUrlTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test new instance
     */
    public function testNewInstance()
    {
        $entity = new ServiceUrl;
        $this->assertEquals(new ArrayCollection, $entity->getUrls(), 'New instance property "urls" is empty collection');
    }

    /**
     * Test accessors
     */
    public function testAccessors()
    {
        $entity = new ServiceUrl;
        $urls = new ArrayCollection;
        $this->assertInstanceOf('Ds\Bundle\ServiceUrlBundle\Entity\ServiceUrl', $entity->setUrls($urls), 'A fluent interface');
        $this->assertEquals($urls, $entity->getUrls(), 'Set value matches get value.');
    }
}
