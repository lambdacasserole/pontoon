<?php

/**
 * A singleton handle on the application configuration file.
 *
 * @author Saul Johnson
 * @since 09/07/2015
 */
class Configuration
{
    /**
     * Holds the single instance of this class.
     *
     * @var Configuration
     */
    private static $instance;

    /**
     * Holds the raw associative array that underlies this class.
     *
     * @var array
     */
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
     * Gets the single instance of this class.
     *
     * @return Configuration
     */
    public static function get()
    {
        if (self::$instance == null)
        {
            self::$instance = new Configuration(__DIR__ . '/../config.yml'); // Load configuration.
        }
        return self::$instance;
    }
}