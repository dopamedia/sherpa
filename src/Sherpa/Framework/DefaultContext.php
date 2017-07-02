<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework;

use Sherpa\Framework\Builder\FlowBuilder;
use Sherpa\Framework\Definition\FlowsDefinition;
use Sherpa\Framework\Definition\FlowDefinition;
use Sherpa\Framework\Util\ServiceHelper;

/**
 * Class Context
 * @package Sherpa\Framework
 */
class DefaultContext implements ContextInterface
{
    /**
     * @var FlowsDefinition[]
     */
    private $flowDefinitions = [];

    /**
     * @var \ArrayObject
     */
    private $flows;

    /**
     * @param FlowBuilder $flowBuilder
     */
    public function addFlows(FlowBuilder $flowBuilder): void
    {
        $flowBuilder->setContext($this);
        $this->flows = $flowBuilder->getFlowsList();
    }

    /**
     * @param \ArrayObject $flows
     * @return void
     */
    public function setFlows(\ArrayObject $flows): void
    {
        $this->flows = $flows;
    }

    /**
     * @param FlowsDefinition[] $flowDefinitions
     * @return void
     */
    public function addFlowDefinitions(array $flowDefinitions): void
    {
        $this->flowDefinitions = $flowDefinitions;
    }

    /**
     * @param FlowDefinition[] $list
     * @return void
     */
    protected function startFlowDefinitions(array $list): void
    {
        /** @var FlowDefinition $flowDefinition */
        foreach ($list as $flowDefinition) {
            $flowDefinition->addFlows($this);
        }
    }

    /**
     * @return void
     */
    public function start(): void
    {
        $this->startFlowDefinitions($this->flowDefinitions);
        $this->startFlow($this->flows);
    }

    /**
     * @param \ArrayObject $flowList
     * @return void
     */
    protected function startFlow(\ArrayObject $flowList): void
    {
        /** @var Flow $flow */
        foreach ($flowList as $flow) {
            $services = $flow->getServices();
            $this->startServices($services);
        }
    }

    /**
     * @param \ArrayObject $services
     * @return void
     */
    protected function startServices(\ArrayObject $services): void
    {
        ServiceHelper::startServices($services->getArrayCopy());
    }

}