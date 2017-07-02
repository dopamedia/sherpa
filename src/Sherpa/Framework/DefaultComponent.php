<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework;

/**
 * Class DefaultComponent
 * @package Sherpa\Framework
 */
abstract class DefaultComponent implements ServiceInterface, ComponentInterface
{

    /**
     * @var ContextInterface
     */
    private $context;

    /**
     * @inheritDoc
     */
    public function getContext(): ContextInterface
    {
        return $this->context;
    }

    /**
     * @inheritDoc
     */
    public function setContext(ContextInterface $context): void
    {
        $this->context = $context;
    }


    /**
     * @inheritDoc
     */
    public function start(): void
    {
    }

}