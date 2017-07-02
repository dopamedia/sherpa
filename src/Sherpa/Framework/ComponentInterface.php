<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework;

/**
 * Interface ComponentInterface
 * @package Sherpa\Framework
 */
interface ComponentInterface
{
    /**
     * @return ContextInterface
     */
    public function getContext(): ContextInterface;

    /**
     * @param ContextInterface $context
     * @return void
     */
    public function setContext(ContextInterface $context): void;

    /**
     * @param string $uri
     * @return EndpointInterface
     */
    public function createEndpoint(string $uri): EndpointInterface;
}