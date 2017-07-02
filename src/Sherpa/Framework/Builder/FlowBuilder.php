<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework\Builder;

use Sherpa\Framework\DefaultContext;
use Sherpa\Framework\EndpointInterface;
use Sherpa\Framework\Definition\FlowsDefinition;
use Sherpa\Framework\Definition\FlowDefinition;

/**
 * Class FlowBuilder
 * @package Sherpa\Framework\Builder
 */
abstract class FlowBuilder
{
    /**
     * @var DefaultContext
     */
    private $context;

    /**
     * @var bool
     */
    private $initialized = false;

    /**
     * @var \ArrayObject|Flow[]
     */
    private $flows;

    /**
     * @var FlowsDefinition
     */
    private $flowDefinitionCollection;

    /**
     * FlowBuilder constructor.
     */
    public function __construct()
    {
        $this->flowDefinitionCollection = new FlowsDefinition();
        $this->flows = new \ArrayObject();
    }

    /**
     * @param EndpointInterface $endpoint
     * @return FlowDefinition
     */
    public function from(EndpointInterface $endpoint): FlowDefinition
    {
        return $this->flowDefinitionCollection->from($endpoint);
    }

    /**
     * @return \ArrayObject
     */
    public function getFlowsList(): \ArrayObject
    {
        $this->initialize();
        return $this->flows;
    }

    private function initialize(): void
    {
        if ($this->initialized === false) {
            $this->configure();
            $this->populateFlows($this->flows);
            $this->initialized = true;
        }
    }

    /**
     * @return void
     */
    abstract protected function configure(): void;

    /**
     * @param \ArrayObject $flows
     */
    private function populateFlows(\ArrayObject $flows): void
    {
        $context = $this->getContext();
        $this->flowDefinitionCollection->setContext($context);
        $context->addFlowDefinitions($this->flowDefinitionCollection->getFlowDefinitions());
    }

    /**
     * @return DefaultContext
     */
    public function getContext(): DefaultContext
    {
        return $this->context;
    }

    /**
     * @param DefaultContext $context
     */
    public function setContext(DefaultContext $context): void
    {
        $this->context = $context;
    }
}