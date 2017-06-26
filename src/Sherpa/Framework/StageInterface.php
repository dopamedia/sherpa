<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 26.06.17
 */

namespace Sherpa\Framework;

/**
 * Interface StageInterface
 * @package Sherpa\Framework
 */
interface StageInterface
{
    /**
     * @param ExchangeInterface $exchange
     * @return ExchangeInterface
     */
    public function process(ExchangeInterface $exchange): ExchangeInterface;
}