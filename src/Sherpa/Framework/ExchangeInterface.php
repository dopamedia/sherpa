<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 26.06.17
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
     * @param MessageInterface $message
     * @return void
     */
    public function setIn(MessageInterface $message): void;

    /**
     * @return MessageInterface
     */
    public function getOut(): MessageInterface;

    /**
     * @param MessageInterface $message
     * @return void
     */
    public function setOut(MessageInterface $message): void;

    /**
     * @return void
     */
    public function flip(): void;

}