<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework\Definition;

use Sherpa\Framework\EndpointInterface;
use Sherpa\Framework\FlowContext;

/**
 * Class FromType
 * @package Sherpa\Framework\Model
 */
class FromDefinition
{
    /**
     * @var EndpointInterface
     */
    private $endpoint;

    /**
     * FromType constructor.
     * @param EndpointInterface $endpoint
     */
    public function __construct(EndpointInterface $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @param FlowContext $flowContext
     * @return EndpointInterface
     */
    public function resolveEndpoint(FlowContext $flowContext): EndpointInterface
    {
        return $this->endpoint;
    }
}