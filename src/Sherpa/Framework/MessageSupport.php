<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework;

/**
 * Class MessageSupport
 * @package Sherpa\Framework
 */
abstract class MessageSupport implements MessageInterface
{
    /**
     * @var null|ExchangeInterface
     */
    private $exchange;

    /**
     * @var null|mixed
     */
    private $body;

    /**
     * @return ExchangeInterface
     */
    public function getExchange(): ExchangeInterface
    {
        return $this->exchange;
    }

    /**
     * @param ExchangeInterface $exchange
     * @return void
     */
    public function setExchange(ExchangeInterface $exchange): void
    {
        $this->exchange = $exchange;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     * @return void
     */
    public function setBody($body): void
    {
        $this->body = $body;
    }

}