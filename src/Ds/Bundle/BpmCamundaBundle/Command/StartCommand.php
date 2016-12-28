<?php

namespace Ds\Bundle\BpmCamundaBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class StartCommand
 */
class StartCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('bpm:camunda:start')
            ->setDescription('Start camunda.')
            ->setHelp('This command allows you to start camunda.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write('Starting camunda... ');
        `docker start camunda`;
        $output->writeln('<info>done.</info>');
    }
}
