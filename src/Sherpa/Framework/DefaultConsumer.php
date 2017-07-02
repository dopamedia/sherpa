<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework;

/**
 * Class DefaultConsumer
 * @package Sherpa\Framework
 */
abstract class DefaultConsumer implements ServiceInterface, ConsumerInterface
{
    /**
     * @var EndpointInterface
     */
    private $endpoint;
    /**
     * @var ProcessorInterface
     */
    private $processor;

    /**
     * DefaultConsumer constructor.
     * @param EndpointInterface $endpoint
     * @param ProcessorInterface $processor
     */
    public function __construct(EndpointInterface $endpoint, ProcessorInterface $processor)
    {
        $this->endpoint = $endpoint;
        $this->processor = $processor;
    }

    /**
     * @return EndpointInterface
     */
    public function getEndpoint(): EndpointInterface
    {
        return $this->endpoint;
    }

    /**
     * @param EndpointInterface $endpoint
     */
    public function setEndpoint(EndpointInterface $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @return ProcessorInterface
     */
    public function getProcessor(): ProcessorInterface
    {
        return $this->processor;
    }

    /**
     * @param ProcessorInterface $processor
     */
    public function setProcessor(ProcessorInterface $processor)
    {
        $this->processor = $processor;
    }

    /**
     * @inheritDoc
     */
    public function start(): void
    {
        ServiceHelper::startServices([$this->processor]);
    }

}