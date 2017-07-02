<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework;

/**
 * Class DefaultEndpoint
 * @package Sherpa\Framework
 */
abstract class DefaultEndpoint implements EndpointInterface
{

    /**
     * @var ContextInterface
     */
    private $context;

    /**
     * DefaultEndpoint constructor.
     * @param ContextInterface $context
     */
    public function __construct(ContextInterface $context)
    {
        $this->context = $context;
    }

    /**
     * @inheritDoc
     */
    public function createExchange(): ExchangeInterface
    {
        return new DefaultExchange($this->context);
    }

}