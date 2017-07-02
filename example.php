<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 13.06.17
 */

require 'vendor/autoload.php';

use Sherpa\Framework\Builder\FlowBuilder;
use Sherpa\Framework\DefaultContext;
use Sherpa\Framework\DefaultConsumer;
use Sherpa\Framework\DefaultEndpoint;
use Sherpa\Framework\DefaultProducer;
use Sherpa\Framework\ExchangeInterface;
use Sherpa\Framework\ProcessorInterface;
use Sherpa\Framework\ProducerInterface;
use Sherpa\Framework\ConsumerInterface;

$context = new DefaultContext();

class FirstConsumer extends DefaultConsumer
{
    /**
     * @inheritDoc
     */
    public function start(): void
    {
        $exchange = $this->getEndpoint()->createExchange();

        try {
            $this->getProcessor()->process($exchange);
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }

    }
}

class FirstEndpoint extends DefaultEndpoint
{
    /**
     * @inheritDoc
     */
    public function createProducer(): ProducerInterface{}

    /**
     * @inheritDoc
     */
    public function createConsumer(ProcessorInterface $processor): ConsumerInterface
    {
        return new FirstConsumer($this, $processor);
    }
}

class SecondEndpoint extends DefaultEndpoint{
    /**
     * @inheritDoc
     */
    public function createProducer(): ProducerInterface
    {
        return new class($this) extends DefaultProducer{

            public function process(ExchangeInterface $exchange): void
            {
                $body = $exchange->getIn()->getBody() . ' - second producer';
                $exchange->getOut()->setBody($body);
            }

        };
    }

    /**
     * @inheritDoc
     */
    public function createConsumer(ProcessorInterface $processor): ConsumerInterface{}

}

class ThirdEndpoint extends DefaultEndpoint{
    /**
     * @inheritDoc
     */
    public function createProducer(): ProducerInterface
    {
        return new class($this) extends DefaultProducer{
            public function process(ExchangeInterface $exchange): void
            {
                $body = $exchange->getIn()->getBody() . ' - third producer';
                $exchange->getOut()->setBody($body);
            }
        };
    }

    /**
     * @inheritDoc
     */
    public function createConsumer(ProcessorInterface $processor): ConsumerInterface{}

}

class FourthEndpoint extends DefaultEndpoint{
    /**
     * @inheritDoc
     */
    public function createProducer(): ProducerInterface
    {
        return new class($this) extends DefaultProducer{
            public function process(ExchangeInterface $exchange): void
            {
                var_dump($exchange->getIn()->getBody() . ' - fourth producer');
            }
        };
    }

    /**
     * @inheritDoc
     */
    public function createConsumer(ProcessorInterface $processor): ConsumerInterface{}

}

$context->addFlows(new class extends FlowBuilder {
    /**
     * @inheritDoc
     */
    protected function configure(): void
    {
        $this->from(new FirstEndpoint($this->getContext()))
            ->to(new SecondEndpoint($this->getContext()))
            ->to(new ThirdEndpoint($this->getContext()))
            ->to(new FourthEndpoint($this->getContext()));
    }

});

$context->start();