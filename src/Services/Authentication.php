<?php

namespace Pontoon\Services;

use Minim\Authenticator;
use Minim\Configuration;

/**
 * Provides access to the application authentication service.
 *
 * @author Saul Johnson
 * @since 25/09/2016
 */
class Authentication
{
    /**
     * The application authentication service instance.
     *
     * @var Authenticator
     */
    private static $auth;

    /**
     * Gets the application authentication service instance.
     *
     * @return Authenticator
     */
    public static function get() {
        if (self::$auth === null) {
            self::$auth = new Authenticator(new Configuration(__DIR__ . '/../../security.yml'));
        }
        return self::$auth;
    }
}