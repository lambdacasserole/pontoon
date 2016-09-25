<?php

namespace Pontoon\Services;

use Pontoon\GlobalConfiguration;

/**
 * Provides access to the application configuration service.
 *
 * @author Saul Johnson
 * @since 25/09/2016
 */
class Configuration
{
    /**
     * The application configuration service instance.
     *
     * @var GlobalConfiguration
     */
    private static $config;

    /**
     * Gets the application configuration service instance.
     *
     * @return GlobalConfiguration
     */
    public static function get() {
        if (self::$config === null) {
            return new GlobalConfiguration(__DIR__ . '/../../config.yml');
        }
        return self::$config;
    }
}