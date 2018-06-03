<?php

namespace Pontoon\Services;

use Pontoon\Configuration;

/**
 * Provides access to the application configuration file.
 *
 * @author Saul Johnson
 * @since 25/09/2016
 */
class ConfigurationService
{
    /**
     * The application configuration instance.
     *
     * @var Configuration
     */
    private static $config;

    /**
     * Gets the application configuration instance.
     *
     * @return Configuration  the application configuration instance
     */
    public static function get() {
        if (self::$config === null) {
            return new Configuration(__DIR__ . '/../../config.yml');
        }
        return self::$config;
    }
}
