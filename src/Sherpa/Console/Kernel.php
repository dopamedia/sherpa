<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 28.06.17
 */

namespace Sherpa\Console;

use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class Kernel
 * @package Sherpa\Console
 */
class Kernel
{
    const VERSION = '0.0.0';

    /**
     * @var bool
     */
    private $booted = false;

    /**
     * @var ContainerBuilder
     */
    private $container;

    /**
     * @return bool
     */
    public function isBooted(): bool
    {
        return $this->booted;
    }

    /**
     * @return ContainerBuilder
     */
    public function getContainer(): ContainerBuilder
    {
        return $this->container;
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        if ($this->booted === true) {
            return;
        }

        $this->initContainer();

        $this->booted = true;
    }

    /**
     * @return void
     */
    protected function initContainer(): void
    {
        $this->container = new ContainerBuilder();

        $this->container->set('kernel', $this);
        $this->container->register('event_dispatcher', \Symfony\Component\EventDispatcher\EventDispatcher::class);

        // register commands
        $this->container->register('dummy_command', \Sherpa\Console\Command\DummyCommand::class)
            ->addTag('console.command');

        // add compiler passes
        $this->container->addCompilerPass(new \Symfony\Component\Console\DependencyInjection\AddConsoleCommandPass());

        $this->container->compile();

    }
}