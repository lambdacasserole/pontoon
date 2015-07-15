<?php

/**
 * Provides static access to the request submitted from the client.
 *
 * @author Saul Johnson
 * @since 14/07/2015
 */
class Request
{
    const POST_KEY_PASSWORD = 'password';
    const POST_KEY_EMAIL = 'email';

    public static function getLoginPassword()
    {
        return isset($_POST[self::POST_KEY_PASSWORD])
            ? $_POST[self::POST_KEY_PASSWORD] : '';
    }

    public static function getLoginEmail()
    {
        return isset($_POST[self::POST_KEY_EMAIL])
            ? $_POST[self::POST_KEY_EMAIL] : '';
    }

    public static function isLoginFormSubmitted()
    {
        return self::getLoginEmail() != '' || self::getLoginPassword() != '';
    }
}