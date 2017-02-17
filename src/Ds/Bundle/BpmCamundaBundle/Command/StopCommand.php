<?php

namespace Ds\Bundle\BpmCamundaBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class StopCommand
 */
class StopCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('bpm:camunda:stop')
            ->setDescription('Stop camunda.')
            ->setHelp('This command allows you to stop camunda.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write('Stopping camunda... ');
        `docker stop camunda`;
        $output->writeln('<info>done.</info>');
    }
}
