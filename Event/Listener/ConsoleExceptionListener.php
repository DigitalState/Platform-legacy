<?php

namespace Ds\Bundle\ConsoleBundle\Event\Listener;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Event\ConsoleExceptionEvent;

/**
 * Class ConsoleExceptionListener
 */
class ConsoleExceptionListener
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $log;

    /**
     * Constructor
     *
     * @param \Psr\Log\LoggerInterface $log
     */
    public function __construct(LoggerInterface $log)
    {
        $this->log = $log;
    }

    /**
     * Console exception callback
     *
     * @param \Symfony\Component\Console\Event\ConsoleExceptionEvent $event
     */
    public function onConsoleException(ConsoleExceptionEvent $event)
    {
        $command = $event->getCommand();
        $exception = $event->getException();

        $message = sprintf(
            '%s: %s (uncaught exception) at %s line %s while running console command `%s`',
            get_class($exception),
            $exception->getMessage(),
            $exception->getFile(),
            $exception->getLine(),
            $command->getName()
        );

        $this->log->error($message, [ 'exception' => $exception ]);
    }
}
