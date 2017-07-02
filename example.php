<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 13.06.17
 */

require 'vendor/autoload.php';

use Sherpa\Framework\Builder\FlowBuilder;
use Sherpa\Framework\Component\Log\LogComponent;
use Sherpa\Framework\Component\Service\ServiceComponent;
use Sherpa\Framework\DefaultContext;
use Sherpa\Framework\DefaultConsumer;
use Sherpa\Framework\DefaultEndpoint;
use Sherpa\Framework\DefaultProducer;
use Sherpa\Framework\ExchangeInterface;
use Sherpa\Framework\ProcessorInterface;
use Sherpa\Framework\ProducerInterface;
use Sherpa\Framework\ConsumerInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

$context = new DefaultContext();

$context->addComponent('log', new LogComponent());

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
        return new class ($this, $processor) extends DefaultConsumer {
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
        };


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
                $body = $exchange->getIn()->getBody() . 'second producer';
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
                $body = $exchange->getIn()->getBody() . ' - fourth producer';
                $exchange->getOut()->setBody($body);
            }
        };
    }

    /**
     * @inheritDoc
     */
    public function createConsumer(ProcessorInterface $processor): ConsumerInterface{}

}

$container = new ContainerBuilder();
$container->register('FirstEndpoint', FirstEndpoint::class);
$container->register('SecondEndpoint', SecondEndpoint::class);
$container->register('ThirdEndpoint', ThirdEndpoint::class);
$container->register('FourthEndpoint', FourthEndpoint::class);

$serviceComponent = new ServiceComponent($container);
$context->addComponent('service', $serviceComponent);

$context->addFlows(new class extends FlowBuilder {
    /**
     * @inheritDoc
     */
    protected function configure(): void
    {
        $this->from('service:FirstEndpoint')
            ->to('service:SecondEndpoint')
            ->to('log')
            ->to('service:ThirdEndpoint')
            ->to('log')
            ->to('service:FourthEndpoint')
            ->to('log');
    }

});

$context->start();