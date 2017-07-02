<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework;

/**
 * Class EventDrivenConsumerFlow
 * @package Sherpa\Framework
 */
class EventDrivenConsumerFlow extends Flow
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
     * EventDrivenConsumerFlow constructor.
     * @param EndpointInterface $endpoint
     * @param ProcessorInterface $processor
     */
    public function __construct(EndpointInterface $endpoint, ProcessorInterface $processor)
    {
        parent::__construct();
        $this->endpoint = $endpoint;
        $this->processor = $processor;
    }

    /**
     * @inheritDoc
     */
    protected function addServices(\ArrayObject $services): void
    {
        $processor = $this->processor;

        if ($processor instanceof ServiceInterface) {
            $services->append($processor);
        }

        $consumer = $this->endpoint->createConsumer($processor);

        if ($consumer !== null) {
            $services->append($consumer);
        }
    }

}