<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework\Definition;

use Sherpa\Framework\DefaultContext;
use Sherpa\Framework\EndpointInterface;

/**
 * Class FlowsDefinition
 * @package Sherpa\Framework\Model
 */
class FlowsDefinition
{
    /**
     * @var DefaultContext
     */
    private $context;

    /**
     * @var FlowsDefinition[]
     */
    private $flowDefinitions;

    /**
     * @return FlowsDefinition[]
     */
    public function getFlowDefinitions(): array
    {
        return $this->flowDefinitions;
    }

    /**
     * @param EndpointInterface $endpoint
     * @return FlowDefinition
     */
    public function from(EndpointInterface $endpoint): FlowDefinition
    {
        $flowDefinition = $this->createFlowDefinition();
        $flowDefinition->from($endpoint);
        return $this->flow($flowDefinition);
    }

    /**
     * @return FlowDefinition
     */
    protected function createFlowDefinition(): FlowDefinition
    {
        return new FlowDefinition();
    }

    /**
     * @param FlowDefinition $flowDefinition
     * @return FlowDefinition
     */
    public function flow(FlowDefinition $flowDefinition): FlowDefinition
    {
        $flowDefinition->setContext($this->getContext());
        $this->flowDefinitions[] = $flowDefinition;
        return $flowDefinition;
    }

    /**
     * @return null|DefaultContext
     */
    public function getContext(): ?DefaultContext
    {
        return $this->context;
    }

    /**
     * @param $context
     */
    public function setContext($context): void
    {
        $this->context = $context;
    }
}