<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 26.06.17
 */

namespace Sherpa\Framework;

/**
 * Class Message
 * @package Sherpa\Framework
 */
class Message implements MessageInterface
{
    /**
     * @var mixed
     */
    private $body;

    /**
     * @inheritdoc
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @inheritdoc
     */
    public function setBody($body): void
    {
        $this->body = $body;
    }
}