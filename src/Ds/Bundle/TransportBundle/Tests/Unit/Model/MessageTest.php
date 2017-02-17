<?php

namespace Ds\Bundle\TransportBundle\Tests\Unit\Model;

use PHPUnit_Framework_TestCase;
use Ds\Bundle\TransportBundle\Model\Message;

/**
 * Class MessageTest
 */
class MessageTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test new instance
     */
    public function testNewInstance()
    {
        $model = new Message;
        $this->assertNull($model->getTo(), 'New instance property "to" is null');
        $this->assertNull($model->getFrom(), 'New instance property "from" is null');
        $this->assertNull($model->getTitle(), 'New instance property "title" is null');
        $this->assertNull($model->getContent(), 'New instance property "content" is null');
    }

    /**
     * Test accessors
     */
    public function testAccessors()
    {
        $model = new Message;
        $to = 'To test';
        $from = 'From test';
        $title = 'Title test';
        $content = 'Content test';
        $this->assertInstanceOf('Ds\Bundle\TransportBundle\Model\Message', $model->setTo($to), 'A fluent interface');
        $this->assertEquals($to, $model->getTo(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\TransportBundle\Model\Message', $model->setFrom($from), 'A fluent interface');
        $this->assertEquals($from, $model->getFrom(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\TransportBundle\Model\Message', $model->setTitle($title), 'A fluent interface');
        $this->assertEquals($title, $model->getTitle(), 'Set value matches get value.');
        $this->assertInstanceOf('Ds\Bundle\TransportBundle\Model\Message', $model->setContent($content), 'A fluent interface');
        $this->assertEquals($content, $model->getContent(), 'Set value matches get value.');
    }
}
