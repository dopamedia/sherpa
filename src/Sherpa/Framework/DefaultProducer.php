<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework;

/**
 * Class DefaultProducer
 * @package Sherpa\Framework
 */
abstract class DefaultProducer implements ServiceInterface, ProducerInterface
{
    /**
     * @var EndpointInterface
     */
    private $endpoint;

    /**
     * DefaultProducer constructor.
     * @param EndpointInterface $endpoint
     */
    public function __construct(EndpointInterface $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @inheritDoc
     */
    public function start(): void
    {
    }
}