<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework;
use Sherpa\Framework\Builder\FlowBuilder;

/**
 * Interface ContextInterface
 * @package Sherpa\Framework
 */
interface ContextInterface
{
    /**
     * @param string $name
     * @param ComponentInterface $component
     * @return void
     */
    public function addComponent(string $name, ComponentInterface $component): void;

    /**
     * @param string $name
     * @return null|ComponentInterface
     */
    public function getComponent(string $name): ?ComponentInterface;

    /**
     * @param string $uri
     * @return EndpointInterface
     */
    public function getEndpoint(string $uri): EndpointInterface;

    /**
     * @param FlowBuilder $flowBuilder
     * @return void
     */
    public function addFlows(FlowBuilder $flowBuilder): void;

    /**
     * @param \ArrayObject $flows
     * @return void
     */
    public function setFlows(\ArrayObject $flows): void;

    /**
     * @param array $flowDefinitions
     * @return void
     */
    public function addFlowDefinitions(array $flowDefinitions): void;

}