<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework\Component\Log;

use Sherpa\Framework\ConsumerInterface;
use Sherpa\Framework\DefaultEndpoint;
use Sherpa\Framework\ExchangeInterface;
use Sherpa\Framework\ProcessorInterface;
use Sherpa\Framework\ProducerInterface;

class LogEndpoint extends DefaultEndpoint
{
    /**
     * @inheritDoc
     */
    public function createProducer(): ProducerInterface
    {
        $logger = $this->createLogger();
        return new LogProducer($this, $logger);
    }

    /**
     * @return ProcessorInterface
     */
    protected function createLogger(): ProcessorInterface
    {
        return new class implements ProcessorInterface {
            public function process(ExchangeInterface $exchange): void
            {
                var_dump($exchange->getIn()->getBody());
            }
        };
    }

    /**
     * @inheritDoc
     */
    public function createConsumer(ProcessorInterface $processor): ConsumerInterface
    {
        // TODO: Implement createConsumer() method.
    }

}