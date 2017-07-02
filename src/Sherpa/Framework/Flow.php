<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework;

/**
 * Class Flow
 * @package Sherpa\Framework
 */
abstract class Flow
{
    /**
     * @var \ArrayObject
     */
    private $services;

    /**
     * Flow constructor.
     */
    public function __construct()
    {
        $this->services = new \ArrayObject();
    }

    /**
     * @return \ArrayObject
     */
    public function getServices(): \ArrayObject
    {
        $this->addServices($this->services);
        return $this->services;
    }

    /**
     * @param \ArrayObject $services
     * @return void
     */
    abstract protected function addServices(\ArrayObject $services): void;

}