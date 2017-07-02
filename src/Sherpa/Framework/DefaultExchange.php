<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework;

/**
 * Class DefaultExchange
 * @package Sherpa\Framework
 */
class DefaultExchange implements ExchangeInterface
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
     * @var ContextInterface
     */
    private $context;

    /**
     * DefaultExchange constructor.
     * @param ContextInterface $context
     */
    public function __construct(ContextInterface $context)
    {
        $this->context = $context;
    }

    /**
     * @inheritDoc
     */
    public function copy(): ExchangeInterface
    {
        return clone $this;
    }

    /**
     * @return MessageInterface
     */
    public function getIn(): MessageInterface
    {
        if ($this->in === null) {
            $in = $this->createInMessage();
            $this->configureMessage($in);
            $this->in = $in;
        }

        return $this->in;
    }

    /**
     * @param MessageInterface $in
     * @return void
     */
    public function setIn(MessageInterface $in): void
    {
        $this->configureMessage($in);
        $this->in = $in;
    }

    /**
     * @return MessageInterface
     */
    public function getOut(): MessageInterface
    {
        if ($this->out === null) {
            $out = $this->createOutMessage();
            $this->configureMessage($out);
            $this->out = $out;
        }
        return $this->out;
    }

    /**
     * @param MessageInterface $out
     * @return void
     */
    public function setOut(MessageInterface $out): void
    {
        $this->out = $out;
    }

    /**
     * @return MessageInterface
     */
    protected function createInMessage(): MessageInterface
    {
        return new DefaultMessage();
    }

    /**
     * @return MessageInterface
     */
    protected function createOutMessage(): MessageInterface
    {
        return new DefaultMessage();
    }

    /**
     * @param MessageInterface $message
     * @return void
     */
    private function configureMessage(MessageInterface $message): void
    {
        if ($message instanceof MessageSupport) {
            $message->setExchange($this);
        }
    }
}