<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 26.06.17
 */

namespace Sherpa\Framework;

/**
 * Class Flow
 * @package Sherpa\Framework
 */
class Flow implements StageInterface
{
    /**
     * @var StageInterface[]
     */
    private $stages = [];

    /**
     * @var ProcessorInterface
     */
    private $processor;

    /**
     * Flow constructor.
     * @param StageInterface[] $stages
     * @param ProcessorInterface $processor
     */
    public function __construct(array $stages, ProcessorInterface $processor)
    {
        $this->stages = $stages;
        $this->processor = $processor;
    }

    /**
     * @inheritdoc
     */
    public function process(ExchangeInterface $exchange): ExchangeInterface
    {
        return $this->processor->process($this->stages, $exchange);
    }

}