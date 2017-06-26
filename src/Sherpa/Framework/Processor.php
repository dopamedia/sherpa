<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 26.06.17
 */

namespace Sherpa\Framework;

/**
 * Class Processor
 * @package Sherpa\Framework
 */
class Processor implements ProcessorInterface
{
    /**
     * @param StageInterface[] $stages
     * @param ExchangeInterface $exchange
     * @return ExchangeInterface
     */
    public function process(array $stages, ExchangeInterface $exchange): ExchangeInterface
    {
        foreach ($stages as $stage) {
            $stage->process($exchange);
            $exchange->flip();
        }

        return $exchange;
    }
}