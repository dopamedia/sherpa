<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework\Processor;

use Sherpa\Framework\EndpointInterface;
use Sherpa\Framework\ExchangeInterface;
use Sherpa\Framework\ProcessorInterface;
use Sherpa\Framework\ProducerInterface;
use Sherpa\Framework\ServiceInterface;

/**
 * Class SendProcessor
 * @package Sherpa\Framework\Processor
 */
class SendProcessor implements ProcessorInterface, ServiceInterface
{
    /**
     * @var EndpointInterface
     */
    private $destination;

    /**
     * @var ProducerInterface
     */
    private $producer;

    /**
     * SendProcessor constructor.
     * @param EndpointInterface $destination
     */
    public function __construct(EndpointInterface $destination)
    {
        $this->destination = $destination;
    }

    /**
     * @inheritDoc
     */
    public function start(): void
    {
        $this->producer = $this->destination->createProducer();
        $this->producer->start();
    }

    /**
     * @inheritdoc
     */
    public function process(ExchangeInterface $exchange): void
    {
        $this->producer->process($exchange);
    }
}