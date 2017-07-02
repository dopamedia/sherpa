<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework;

/**
 * Interface ExchangeInterface
 * @package Sherpa\Framework
 */
interface ExchangeInterface
{
    /**
     * @return MessageInterface
     */
    public function getIn(): MessageInterface;

    /**
     * @return MessageInterface
     */
    public function getOut(): MessageInterface;

    /**
     * @return ExchangeInterface
     */
    public function copy(): ExchangeInterface;
}