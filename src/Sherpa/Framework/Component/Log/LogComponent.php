<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework\Component\Log;

use Sherpa\Framework\DefaultComponent;
use Sherpa\Framework\EndpointInterface;

/**
 * Class LogComponent
 * @package Sherpa\Framework\Component\Log
 */
class LogComponent extends DefaultComponent
{
    /**
     * @inheritDoc
     */
    public function createEndpoint(string $uri): EndpointInterface
    {
        return new LogEndpoint($uri, $this);
    }

}