<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework;

/**
 * Interface MessageInterface
 * @package Sherpa\Framework
 */
interface MessageInterface
{
    /**
     * @return ExchangeInterface
     */
    public function getExchange(): ExchangeInterface;

    /**
     * @return mixed
     */
    public function getBody();

    /**
     * @param mixed $body
     * @return void
     */
    public function setBody($body): void;
}