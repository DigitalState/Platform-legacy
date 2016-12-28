<?php

namespace Ds\Bundle\ConsoleBundle\Event\Listener;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Event\ConsoleTerminateEvent;

/**
 * Class ConsoleErrorListener
 */
class ConsoleErrorListener
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
     * Console terminate callback
     *
     * @param \Symfony\Component\Console\Event\ConsoleTerminateEvent $event
     */
    public function onConsoleTerminate(ConsoleTerminateEvent $event)
    {
        $statusCode = $event->getExitCode();
        $command = $event->getCommand();

        if ($statusCode === 0) {
            return;
        }

        if ($statusCode > 255) {
            $statusCode = 255;
            $event->setExitCode($statusCode);
        }

        $message = sprintf(
            'Command `%s` exited with status code %d',
            $command->getName(),
            $statusCode
        );

        $this->log->warning($message);
    }
}
