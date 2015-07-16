<?php

/**
 * A singleton handle on the application configuration file.
 *
 * @author Saul Johnson
 * @since 09/07/2015
 */
class Configuration
{
    private static $instance;
    private $config;

    private function __construct($path)
    {
        $this->config = Spyc::YAMLLoad($path);
    }

    public function getRootPath()
    {
        return $this->config['root_path'];
    }

    public function getDeployonfigName()
    {
        return $this->config['deploy_config_name'];
    }

    public function getAdminEmail()
    {
        return $this->config['admin_email'];
    }

    public function getAdminPasswordHash()
    {
        return $this->config['admin_password_hash'];
    }

    public function getSecretKey()
    {
        return $this->config['secret_key'];
    }

    public static function get()
    {
        if (self::$instance == null)
        {
            self::$instance = new Configuration('config.yml');
        }
        return self::$instance;
    }
}