<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 26.06.17
 */

namespace Sherpa\Framework;

/**
 * Interface MessageInterface
 * @package Sherpa\Framework
 */
interface MessageInterface
{
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