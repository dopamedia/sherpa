<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 26.06.17
 */

namespace Sherpa\Framework;

/**
 * Interface ProcessorInterface
 * @package Sherpa\Framework
 */
interface ProcessorInterface
{
    /**
     * @param array $stages
     * @param ExchangeInterface $exchange
     * @return ExchangeInterface
     */
    public function process(array $stages, ExchangeInterface $exchange): ExchangeInterface;
}