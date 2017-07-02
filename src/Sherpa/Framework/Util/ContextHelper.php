<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework\Util;

use Sherpa\Framework\ContextInterface;
use Sherpa\Framework\EndpointInterface;

/**
 * Class ContextHelper
 * @package Sherpa\Framework\Util
 */
class ContextHelper
{
    /**
     * @param ContextInterface $context
     * @param string $uri
     * @return EndpointInterface
     */
    public static function getMandatoryEndpoint(ContextInterface $context, string $uri): EndpointInterface
    {
        // TODO::throw exception if endpoint is not available
        return $context->getEndpoint($uri);
    }
}