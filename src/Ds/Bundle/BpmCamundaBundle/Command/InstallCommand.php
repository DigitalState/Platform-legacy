<?php

namespace Ds\Bundle\BpmCamundaBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class InstallCommand
 */
class InstallCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('bpm:camunda:install')
            ->setDescription('Installs camunda.')
            ->setHelp('This command allows you to install camunda.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write('Installing camunda... ');
        `docker run -d --name camunda --net="host" -e TZ=America/Toronto camunda/camunda-bpm-platform:latest`;
        $output->writeln('<info>done.</info>');
    }
}
