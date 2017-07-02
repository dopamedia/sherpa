<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework\Definition;

use Sherpa\Framework\EndpointInterface;
use Sherpa\Framework\FlowContext;

/**
 * Class FromDefinition
 * @package Sherpa\Framework\Definition
 */
class FromDefinition
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
     * FromDefinition constructor.
     * @param string $uri
     */
    public function __construct(string $uri)
    {
        $this->uri = $uri;
    }

    /**
     * @param FlowContext $flowContext
     * @return EndpointInterface
     */
    public function resolveEndpoint(FlowContext $flowContext): EndpointInterface
    {
        return $this->endpoint ?: $flowContext->resolveEndpoint($this->uri);
    }

}