<?php

namespace Ds\Bundle\TransportBundle\Tests\Unit\Transport\Email;

use PHPUnit_Framework_TestCase;
use Ds\Bundle\TransportBundle\Transport\Email\MailTransport;
use Ds\Bundle\TransportBundle\Entity\Profile;

/**
 * Class MailTransportTest
 */
class MailTransportTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test new instance
     */
    public function testNewInstance()
    {
        $transport = new MailTransport;
        $this->assertNull($transport->getProfile(), 'New instance property "profile" is null');
    }

    /**
     * Test accessors
     */
    public function testAccessors()
    {
        $profile = new Profile;
        $transport = new MailTransport;
        $this->assertInstanceOf('Ds\Bundle\TransportBundle\Transport\Email\MailTransport', $transport->setProfile($profile), 'A fluent interface');
        $this->assertEquals($profile, $transport->getProfile(), 'Set value matches get value.');
    }
}
