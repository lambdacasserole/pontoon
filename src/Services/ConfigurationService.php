<?php

namespace Pontoon\Services;

use Pontoon\Configuration;

/**
 * Provides access to the application configuration service.
 *
 * @author Saul Johnson
 * @since 25/09/2016
 */
class ConfigurationService
{
    /**
     * The application configuration service instance.
     *
     * @var Configuration
     */
    private static $config;

    /**
     * Gets the application configuration service instance.
     *
     * @return Configuration
     */
    public static function get() {
        if (self::$config === null) {
            return new Configuration(__DIR__ . '/../../config.yml');
        }
        return self::$config;
    }
}