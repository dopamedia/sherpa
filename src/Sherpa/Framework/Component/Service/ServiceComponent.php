<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework\Component\Service;

use Sherpa\Framework\DefaultComponent;
use Sherpa\Framework\EndpointInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class ServiceComponent
 * @package Sherpa\Framework\Component\Service
 */
class ServiceComponent extends DefaultComponent
{
    use ContainerAwareTrait;

    /**
     * ServiceComponent constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->setContainer($container);
    }

    /**
     * @inheritDoc
     */
    public function createEndpoint(string $uri): EndpointInterface
    {
        return new ServiceEndpoint($uri, $this, $this->container);
    }

}