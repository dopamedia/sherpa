<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework\Definition;

use Sherpa\Framework\EndpointInterface;
use Sherpa\Framework\Processor\SendProcessor;
use Sherpa\Framework\FlowContext;
use Sherpa\Framework\ProcessorInterface;

/**
 * Class ToType
 * @package Sherpa\Framework\Model
 */
class ToDefinition extends ProcessorDefinition
{
    /**
     * @var EndpointInterface
     */
    private $endpoint;

    /**
     * ToType constructor.
     * @param EndpointInterface $endpoint
     */
    public function __construct(EndpointInterface $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @inheritDoc
     */
    public function createProcessor(FlowContext $flowContext): ProcessorInterface
    {
        return new SendProcessor($this->endpoint);
    }
}