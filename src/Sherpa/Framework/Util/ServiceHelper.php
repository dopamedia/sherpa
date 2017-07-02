<?php
/**
 * User: Andreas Penz <office@dopa.media>
 * Date: 02.07.17
 */

namespace Sherpa\Framework\Util;

use Sherpa\Framework\ServiceInterface;

/**
 * Class ServiceHelper
 * @package Sherpa\Framework\Util
 */
class ServiceHelper
{
    /**
     * @param ServiceInterface[] $services
     * @return void
     */
    public static function startServices(array $services): void
    {
        foreach ($services as $service) {
            if ($service instanceof ServiceInterface) {
                $service->start();
            }
        }
    }
}