<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework\Component\Service;

use Sherpa\Framework\ComponentInterface;
use Sherpa\Framework\ConsumerInterface;
use Sherpa\Framework\DefaultEndpoint;
use Sherpa\Framework\EndpointInterface;
use Sherpa\Framework\ProcessorInterface;
use Sherpa\Framework\ProducerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ServiceEndpoint extends DefaultEndpoint
{

    use ContainerAwareTrait;

    /**
     * @inheritDoc
     */
    public function __construct(
        string $endpointUri,
        ComponentInterface $component,
        ContainerInterface $container
    ) {
        parent::__construct($endpointUri, $component);
        $this->setContainer($container);
    }

    /**
     * @return EndpointInterface
     * @throws \Exception
     */
    private function getClassEndpoint(): EndpointInterface
    {
        $serviceId = substr($this->getEndpointUri(), strpos($this->getEndpointUri(), ':') + 1);

        /** @var EndpointInterface $endpoint */
        $endpoint = $this->container->get($serviceId);

        if (!$endpoint instanceof EndpointInterface) {
            throw new \Exception('Class must implement EndpointInterface');
        }

        return $endpoint;
    }


    /**
     * @inheritDoc
     */
    public function createProducer(): ProducerInterface
    {
        return $this->getClassEndpoint()->createProducer();
    }

    /**
     * @inheritDoc
     */
    public function createConsumer(ProcessorInterface $processor): ConsumerInterface
    {
        return $this->getClassEndpoint()->createConsumer($processor);
    }

}