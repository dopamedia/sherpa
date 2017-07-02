<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework\Definition;

use Sherpa\Framework\DefaultContext;
use Sherpa\Framework\EndpointInterface;
use Sherpa\Framework\FlowContext;

/**
 * Class FlowDefinition
 * @package Sherpa\Framework\Model
 */
class FlowDefinition
{
    /**
     * @var FromDefinition[]
     */
    private $inputs = [];

    /**
     * @var ProcessorDefinition[]
     */
    private $outputs = [];

    /**
     * @var DefaultContext
     */
    private $context;

    /**
     * @param EndpointInterface $endpoint
     * @return FlowDefinition
     */
    public function from(EndpointInterface $endpoint): FlowDefinition
    {
        $this->inputs[] = new FromDefinition($endpoint);
        return $this;
    }

    /**
     * @param EndpointInterface $endpoint
     * @return FlowDefinition
     */
    public function to(EndpointInterface $endpoint): FlowDefinition
    {
        $this->outputs[] = new ToDefinition($endpoint);
        return $this;
    }

    /**
     * @param DefaultContext $context
     */
    public function addFlows(DefaultContext $context): void
    {
        $flows = new \ArrayObject();

        $this->setContext($context);

        foreach ($this->inputs as $fromType) {
            $this->addFlowsFromType($flows, $fromType);
        }

        $context->setFlows($flows);
    }

    /**
     * @param null|DefaultContext $context
     * @return void
     */
    public function setContext(?DefaultContext $context): void
    {
        $this->context = $context;
    }

    /**
     * @param \ArrayObject $flows
     * @param FromDefinition $fromType
     */
    private function addFlowsFromType(\ArrayObject $flows, FromDefinition $fromType): void
    {
        $flowContext = new FlowContext($this, $fromType, $flows);

        /** @var ProcessorDefinition $output */
        foreach ($this->outputs as $output) {
            $output->addFlows($flowContext, $flows);
        }

        $flowContext->commit();
    }

}