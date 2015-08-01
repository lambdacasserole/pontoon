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

    /**
     * Private constructor for a handle on the application configuration file.
     *
     * @param string $path  the path to read the configuration file from
     */
    private function __construct($path)
    {
        $this->config = Spyc::YAMLLoad($path);
    }

    /**
     * Gets the root path that contains website directories.
     *
     * @return string   the root directory path
     */
    public function getRootPath()
    {
        return $this->config['root_path'];
    }

    /**
     * Gets the name of the deploy configuration file to look for.
     *
     * @return string
     */
    public function getDeployConfigName()
    {
        return $this->config['deploy_config_name'];
    }

    /**
     * Gets the admin email address required for login to the deployments page.
     *
     * @return string
     */
    public function getAdminEmail()
    {
        return $this->config['admin_email'];
    }

    /**
     * Gets the password hash required for login to the deployments page.
     *
     * @return string
     */
    public function getAdminPasswordHash()
    {
        return $this->config['admin_password_hash'];
    }

    /**
     * Gets the secret key used by the application for symmetric encryption purposes.
     *
     * @return string
     */
    public function getSecretKey()
    {
        return $this->config['secret_key'];
    }

    /**
     * Gets the single instance of this class.
     *
     * @return Configuration
     */
    public static function get()
    {
        if (self::$instance == null)
        {
            self::$instance = new Configuration('config.yml'); // Load configuration.
        }
        return self::$instance;
    }
}