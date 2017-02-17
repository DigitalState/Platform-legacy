# Platform-Transport-Bundle

The Transport bundle provides the developers the foundation and common API for sending messages programmatically. It introduces two new entities to the system: [Transport](Entity/Transport.php) and [Profile](Entity/Profile.php).

[![Code Climate](https://codeclimate.com/github/DigitalState/Platform-Transport-Bundle/badges/gpa.svg)](https://codeclimate.com/github/DigitalState/Platform-Transport-Bundle)
[![Test Coverage](https://codeclimate.com/github/DigitalState/Platform-Transport-Bundle/badges/coverage.svg)](https://codeclimate.com/github/DigitalState/Platform-Transport-Bundle/coverage)

## Table of Contents

- [Transport Entity](#transport-entity)
- [Profile Entity](#profile-entity)
- [Todo](#todo)

## Transport Entity

Transports are in charge of sending messages to recipients. For example, the developer could define a Transport that knows how to send messages via Twilio SMS.

Internally, each Transport is associated with a PHP class. To create a Transport class, the developer needs to implement the [Transport Interface](Transport/Transport.php).

**Example** `src/Gov/Bundle/DemoBundle/Transport/Sms/TwilioTransport.php`:

```php
<?php

namespace Gov\Bundle\DemoBundle\Transport\Sms;

use Ds\Bundle\TransportBundle\Transport\Transport;
use Ds\Bundle\TransportBundle\Model\Message;
use Ds\Bundle\TransportBundle\Entity\Profile;
use UnexpectedValueException;

class TwilioTransport implements Transport
{
    // ...
    
    public function send(Message $message, Profile $profile = null)
    {
        // Use Twilio SDK to send message.
        // ...
        $success = true;
        //

        if (!$success) {
            throw new UnexpectedValueException('Message could not be sent.');
        }

        return $this;
    }
}
```

A Transport class needs to be registered as a service in the Symfony Service Container and be tagged with the `ds.transport` tag.

**Example** `src/Gov/Bundle/DemoBundle/Resources/config/services.yml`:

```yml
services:
    gov.demo.transport.sms.twilio:
        class: Gov\Bundle\DemoBundle\Transport\Sms\TwilioTransport
        tags:
            - { name: ds.transport, implementation: sms.twilio }
```

*The `implementation` attribute is a string value that identifies programmatically a Transport and should be unique.*

## Profile Entity

A Profile is associated to a Transport and defines the configurations needed by that Transport. Configurations such as hostname, username, password, api key, secret key, etc. For example, a business user could create a Profile via the administrative interface, associate it with the Twilio Transport and provide the needed configurations such as the Twilio api key and credentials.

It is possible to create multiple Profiles for a single Transport. The business user may eventually choose which Profile to use when sending a specific message. For example, Twilio provides different account credentials based on the different geographic areas you want to send messages from.

## Todo
