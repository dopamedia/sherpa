<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework;

/**
 * Class DefaultEndpoint
 * @package Sherpa\Framework
 */
abstract class DefaultEndpoint implements EndpointInterface
{
    /**
     * @var null|string
     */
    private $endpointUri;

    /**
     * @var ComponentInterface
     */
    private $component;

    /**
     * @var null|ContextInterface
     */
    private $context;

    /**
     * DefaultEndpoint constructor.
     * @param string $endpointUri
     * @param ComponentInterface|null $component
     */
    public function __construct(
        string $endpointUri = null,
        ComponentInterface $component = null
    )
    {
        $this->endpointUri = $endpointUri;
        $this->component = $component;
        $this->context = ($component !== null) ? $component->getContext() : null;
    }

    /**
     * @return null|string
     */
    public function getEndpointUri(): ?string
    {
        return $this->endpointUri;
    }

    /**
     * @return ComponentInterface
     */
    public function getComponent(): ComponentInterface
    {
        return $this->component;
    }

    /**
     * @inheritDoc
     */
    public function createExchange(): ExchangeInterface
    {
        return new DefaultExchange($this->context);
    }

}