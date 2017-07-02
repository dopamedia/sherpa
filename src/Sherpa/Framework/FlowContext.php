<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework;

use Sherpa\Framework\Definition\FromDefinition;
use Sherpa\Framework\Definition\FlowDefinition;
use Sherpa\Framework\Processor\Pipeline;

/**
 * Class FlowContext
 * @package Sherpa\Framework
 */
class FlowContext
{
    /**
     * @var ContextInterface
     */
    private $context;

    /**
     * @var FlowDefinition
     */
    private $flowDefinition;

    /**
     * @var FromDefinition
     */
    private $fromDefinition;

    /**
     * @var \ArrayObject|Flow[]
     */
    private $flows;

    /**
     * @var array
     */
    private $eventDrivenProcessors = [];

    /**
     * @var null|EndpointInterface
     */
    private $endpoint = null;

    /**
     * FlowContext constructor.
     * @param ContextInterface $context
     * @param FlowDefinition $flowDefinition
     * @param FromDefinition $fromDefinition
     * @param \ArrayObject $flows
     */
    public function __construct(
        ContextInterface $context,
        FlowDefinition $flowDefinition,
        FromDefinition $fromDefinition,
        \ArrayObject $flows
    ) {
        $this->context = $context;
        $this->flowDefinition = $flowDefinition;
        $this->fromDefinition = $fromDefinition;
        $this->flows = $flows;
    }

    /**
     * @param ProcessorInterface $processor
     */
    public function addEventDrivenProcessor(ProcessorInterface $processor): void
    {
        $this->eventDrivenProcessors[] = $processor;
    }

    /**
     * @return void
     */
    public function commit(): void
    {
        if (!empty($this->eventDrivenProcessors)) {
            $processor = Pipeline::newInstance($this->eventDrivenProcessors);
            $this->flows->append(new EventDrivenConsumerFlow($this->getEndpoint(), $processor));
        }
    }

    /**
     * @return EndpointInterface
     */
    public function getEndpoint(): EndpointInterface
    {
        if ($this->endpoint === null) {
            $this->endpoint = $this->fromDefinition->resolveEndpoint($this);
        }
        return $this->endpoint;
    }

    /**
     * @param string $uri
     * @return EndpointInterface
     */
    public function resolveEndpoint(string $uri): EndpointInterface
    {
        return $this->flowDefinition->resolveEndpoint($this->context, $uri);
    }

}
