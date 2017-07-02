<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework;


interface EndpointInterface
{
    /**
     * @return ProducerInterface
     */
    public function createProducer(): ProducerInterface;

    /**
     * @param ProcessorInterface $processor
     * @return ConsumerInterface
     */
    public function createConsumer(ProcessorInterface $processor): ConsumerInterface;

    /**
     * @return ExchangeInterface
     */
    public function createExchange(): ExchangeInterface;

}