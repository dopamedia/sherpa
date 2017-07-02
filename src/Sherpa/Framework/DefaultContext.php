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
class DefaultContext implements ServiceInterface, ContextInterface
{
    /**
     * @var EndpointInterface[]
     */
    private $endpoints = [];

    /**
     * @var ComponentInterface[]
     */
    private $components = [];

    /**
     * @var FlowsDefinition[]
     */
    private $flowDefinitions = [];

    /**
     * @var \ArrayObject
     */
    private $flows;

    /**
     * @inheritDoc
     */
    public function addComponent(string $name, ComponentInterface $component): void
    {
        $component->setContext($this);
        $this->components[$name] = $component;
    }

    /**
     * @inheritDoc
     */
    public function getComponent(string $name): ?ComponentInterface
    {
        return array_key_exists($name, $this->components) ? $this->components[$name] : null;
    }

    /**
     * @inheritDoc
     */
    public function getEndpoint(string $uri): EndpointInterface
    {
        $scheme = strtok($uri, ':');
        return $this->getComponent($scheme)->createEndpoint($uri);
    }

    /**
     * @inheritdoc
     */
    public function addFlows(FlowBuilder $flowBuilder): void
    {
        $flowBuilder->setContext($this);
        $this->flows = $flowBuilder->getFlowsList();
    }

    /**
     * @inheritdoc
     */
    public function setFlows(\ArrayObject $flows): void
    {
        $this->flows = $flows;
    }

    /**
     * @inheritdoc
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
     * @inheritdoc
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