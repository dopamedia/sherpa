<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 26.06.17
 */

namespace Sherpa\Framework;

/**
 * Class FlowBuilder
 * @package Sherpa\Framework
 */
class FlowBuilder implements FlowBuilderInterface
{
    /**
     * @var StageInterface[]
     */
    private $stages = [];

    /**
     * @inheritDoc
     */
    public function add(StageInterface $stage): FlowBuilderInterface
    {
        $this->stages[] = $stage;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function build(): StageInterface
    {
        return new Flow($this->stages, new Processor());
    }

}