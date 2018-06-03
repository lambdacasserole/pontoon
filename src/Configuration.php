<?php

namespace Pontoon;

use Spyc;

/**
 * Represents a handle on the application configuration file.
 *
 * @author Saul Johnson
 * @since 09/07/2015
 */
class Configuration
{
    /**
     * The raw associative array that underlies this class.
     *
     * @var array
     */
    private $config;

    /**
     * Initializes a new instance of a handle on the application configuration file.
     *
     * @param string $path  the path to read the application configuration file from
     */
    public function __construct($path)
    {
        $this->config = Spyc::YAMLLoad($path);
    }

    /**
     * Gets the root path that contains website directories.
     *
     * @return string the root path that contains website directories
     */
    public function getRootPath()
    {
        return $this->config['root_path'];
    }

    /**
     * Gets the name of the deploy configuration files to look for.
     *
     * @return string the name of the deploy configuration files to look for
     */
    public function getDeployConfigName()
    {
        return $this->config['deploy_config_name'];
    }

    /**
     * Gets the API key that can be used to deploy an application.
     *
     * @return string the API key that can be used to deploy an application
     */
    public function getApiKey()
    {
       return $this->config['api_key'];
    }

    /**
     * Gets the salt used to compute deploy IDs.
     *
     * @return string the salt used to compute deploy IDs
     */
    public function getIdSalt()
    {
      return $this->config['id_salt'];
    }
}
