<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework\Definition;

use Sherpa\Framework\EndpointInterface;
use Sherpa\Framework\FlowContext;
use Sherpa\Framework\Processor\SendProcessor;
use Sherpa\Framework\ProcessorInterface;

/**
 * Class ToDefinition
 * @package Sherpa\Framework\Definition
 */
class ToDefinition extends ProcessorDefinition
{
    /**
     * @var string
     */
    private $uri;

    /**
     * @var null|EndpointInterface
     */
    private $endpoint;

    /**
     * ToDefinition constructor.
     * @param string $uri
     */
    public function __construct(string $uri)
    {
        $this->uri = $uri;
    }

    /**
     * @inheritDoc
     */
    public function createProcessor(FlowContext $flowContext): ProcessorInterface
    {
        $endpoint = $this->resolveEndpoint($flowContext);
        return new SendProcessor($endpoint);
    }

    /**
     * @param FlowContext $flowContext
     * @return EndpointInterface
     */
    public function resolveEndpoint(FlowContext $flowContext): EndpointInterface
    {
        if ($this->endpoint === null) {
            $this->endpoint = $flowContext->resolveEndpoint($this->uri);
        }
        return $this->endpoint;
    }

}