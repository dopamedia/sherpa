<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 26.06.17
 */

namespace Sherpa\Framework;

/**
 * Class Exchange
 * @package Sherpa\Framework
 */
class Exchange implements ExchangeInterface
{
    /**
     * @var null|MessageInterface
     */
    private $in;

    /**
     * @var null|MessageInterface
     */
    private $out;

    /**
     * @inheritDoc
     */
    public function getIn(): MessageInterface
    {
        if ($this->in === null) {
            $this->in = $this->createMessage();
        }

        return $this->in;
    }

    /**
     * @inheritDoc
     */
    public function setIn(MessageInterface $message): void
    {
        $this->in = $message;
    }

    /**
     * @inheritDoc
     */
    public function getOut(): MessageInterface
    {
        if ($this->out === null) {
            $this->out = $this->createMessage();
        }

        return $this->out;
    }

    /**
     * @inheritDoc
     */
    public function setOut(MessageInterface $message): void
    {
        $this->out = $message;
    }

    /**
     * @inheritDoc
     */
    private function createMessage(): MessageInterface
    {
        return new Message();
    }

    /**
     * @inheritDoc
     */
    public function flip(): void
    {
        if ($this->out !== null) {
            $this->in = $this->out;
            $this->out = null;
        }
    }
}