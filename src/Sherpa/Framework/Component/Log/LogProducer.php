<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework\Component\Log;

use Sherpa\Framework\DefaultProducer;
use Sherpa\Framework\EndpointInterface;
use Sherpa\Framework\ExchangeInterface;
use Sherpa\Framework\ProcessorInterface;

/**
 * Class LogProducer
 * @package Sherpa\Framework\Component\Log
 */
class LogProducer extends DefaultProducer
{
    /**
     * @var ProcessorInterface
     */
    private $logger;

    /**
     * LogProducer constructor.
     * @param EndpointInterface $endpoint
     * @param ProcessorInterface $logger
     */
    public function __construct(EndpointInterface $endpoint, ProcessorInterface $logger)
    {
        parent::__construct($endpoint);
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function process(ExchangeInterface $exchange): void
    {
        $this->logger->process($exchange);
    }

}