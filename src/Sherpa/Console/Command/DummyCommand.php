<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 28.06.17
 */

namespace Sherpa\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DummyCommand
 * @package Sherpa\Console\Command
 */
class DummyCommand extends Command
{
    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('dummy');
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('dummy command');
    }

}