<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework\Definition;

use Sherpa\Framework\ContextInterface;
use Sherpa\Framework\DefaultContext;
use Sherpa\Framework\EndpointInterface;
use Sherpa\Framework\FlowContext;
use Sherpa\Framework\Util\ContextHelper;

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
     * @param string $uri
     * @return FlowDefinition
     */
    public function from(string $uri): FlowDefinition
    {
        $this->inputs[] = new FromDefinition($uri);
        return $this;
    }

    /**
     * @param string $uri
     * @return FlowDefinition
     */
    public function to(string $uri): FlowDefinition
    {
        $this->outputs[] = new ToDefinition($uri);
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
        $flowContext = new FlowContext($this->context, $this, $fromType, $flows);

        /** @var ProcessorDefinition $output */
        foreach ($this->outputs as $output) {
            $output->addFlows($flowContext, $flows);
        }

        $flowContext->commit();
    }

    /**
     * @param ContextInterface $context
     * @param string $uri
     * @return EndpointInterface
     */
    public function resolveEndpoint(ContextInterface $context, string $uri): EndpointInterface
    {
        return ContextHelper::getMandatoryEndpoint($context, $uri);
    }

}