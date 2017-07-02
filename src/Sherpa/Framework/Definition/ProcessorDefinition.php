<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework\Definition;

use Sherpa\Framework\ProcessorInterface;
use Sherpa\Framework\FlowContext;

/**
 * Class ProcessorType
 * @package Sherpa\Framework\Model
 */
abstract class ProcessorDefinition
{
    /**
     * @param FlowContext $flowContext
     * @param \ArrayObject $flows
     * @return void
     */
    public function addFlows(FlowContext $flowContext, \ArrayObject $flows): void
    {
        $processor = $this->makeProcessor($flowContext);
        $flowContext->addEventDrivenProcessor($processor);
    }

    private function makeProcessor(FlowContext $flowContext)
    {
        $processor = $this->createProcessor($flowContext);
        return $this->wrapProcessor($flowContext, $processor);
    }

    /**
     * @param FlowContext $flowContext
     * @return ProcessorInterface
     */
    abstract public function createProcessor(FlowContext $flowContext): ProcessorInterface;

    /**
     * @param $flowContext
     * @param $processor
     * @return ProcessorInterface
     */
    private function wrapProcessor($flowContext, $processor): ProcessorInterface
    {
        return $processor;
    }
}