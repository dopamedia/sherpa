<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework;

/**
 * Interface ServiceInterface
 * @package Sherpa\Framework
 */
interface ServiceInterface
{
    /**
     * @return void
     */
    public function start(): void;
}