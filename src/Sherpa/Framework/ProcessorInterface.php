<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework;

/**
 * Interface ProcessorInterface
 * @package Sherpa\Framework
 */
interface ProcessorInterface
{
    /**
     * @param ExchangeInterface $exchange
     * @return void
     */
    public function process(ExchangeInterface $exchange): void;
}