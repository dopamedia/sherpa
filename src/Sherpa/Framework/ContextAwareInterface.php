<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework;

/**
 * Interface ContextAwareInterface
 * @package Sherpa\Framework
 */
interface ContextAwareInterface
{
    /**
     * @return ContextInterface
     */
    public function getContext(): ContextInterface;

    /**
     * @param ContextInterface $context
     */
    public function setContext(ContextInterface $context): void;

}