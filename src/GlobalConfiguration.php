<?php

namespace Pontoon;

use Spyc;

/**
 * Represents a handle on the global configuration file.
 *
 * @package Pontoon
 * @author Saul Johnson
 * @since 09/07/2015
 */
class GlobalConfiguration
{
    /**
     * The raw associative array that underlies this class.
     *
     * @var array
     */
    private $config;

    /**
     * Initializes a new instance of a handle on the global configuration file.
     *
     * @param string $path  the path to read the global configuration file from
     */
    public function __construct($path)
    {
        $this->config = Spyc::YAMLLoad($path);
    }

    /**
     * Gets the root path that contains website directories.
     *
     * @return string
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
}