<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 27.06.17
 */

namespace Sherpa\Console;

use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Application
 * @package Sherpa\Console
 */
class Application extends BaseApplication
{
    /**
     * @var Kernel
     */
    private $kernel;

    /**
     * @var bool
     */
    private $commandsRegistered = false;

    /**
     * Application constructor.
     * @param Kernel $kernel
     */
    public function __construct(Kernel $kernel)
    {
        $this->kernel = $kernel;
        parent::__construct('Sherpa', Kernel::VERSION);
    }

    /**
     * @return Kernel
     */
    public function getKernel(): Kernel
    {
        return $this->kernel;
    }

    /**
     * @inheritDoc
     */
    public function doRun(InputInterface $input, OutputInterface $output)
    {
        $this->kernel->boot();

        $container = $this->kernel->getContainer();

        $this->setDispatcher($container->get('event_dispatcher'));

        return parent::doRun($input, $output);
    }

    /**
     * @inheritDoc
     */
    public function find($name)
    {
        $this->registerCommands();
        return parent::find($name);
    }

    /**
     * @inheritDoc
     */
    public function get($name)
    {
        $this->registerCommands();
        return parent::get($name);
    }

    /**
     * @inheritDoc
     */
    public function all($namespace = null)
    {
        $this->registerCommands();
        return parent::all($namespace);
    }

    /**
     * @return void
     */
    protected function registerCommands(): void
    {
        if ($this->commandsRegistered === true) {
            return;
        }

        $this->kernel->boot();

        $container = $this->kernel->getContainer();

        if ($container->hasParameter('console.command.ids')) {
            foreach ($container->getParameter('console.command.ids') as $id) {
                $this->add($container->get($id));
            }
        }

        $this->commandsRegistered = true;

    }

}