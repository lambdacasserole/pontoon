<?php

namespace Pontoon;

use Spyc;

/**
 * Represents a configuration file for a specific deploy target.
 *
 * @author Saul Johnson
 * @since 13/07/2015
 */
class DeployConfiguration
{
    private $config;
    private $path;

    /**
     * Initialises a new instance of a deploy configuration file.
     *
     * @param string $path  the path to the configuration file to load
     */
    public function __construct($path)
    {
        $this->path = $path;
        $this->config = Spyc::YAMLLoad($path);
    }

    /**
     * Gets the project name.
     *
     * @return string
     */
    public function getProjectName()
    {
        return $this->config['project_name'];
    }

    /**
     * Gets the project description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->config['description'];
    }

    /**
     * Gets whether or not deployment of this project is enabled.
     *
     * @return bool
     */
    public function isDeployEnabled()
    {
        return $this->config['deploy_enabled'];
    }

    /**
     * Gets the filename of the deploy script for this project.
     *
     * @return string
     */
    public function getDeployScript()
    {
        return $this->config['deploy_script'];
    }

    /**
     * Gets the full path of the deploy script for this project.
     *
     * @return string
     */
    public function getFullDeployScriptPath()
    {
        return $this->getDirectoryPath() . '/' . $this->getDeployScript();
    }

    /**
     * Gets the name of the scripting executable to use to execute the deploy script.
     *
     * @return string
     */
    public function getScriptingExecutable()
    {
        return $this->config['scripting_exe'];
    }

    /**
     * Gets the command needed to run the deploy script.
     *
     * @return string
     */
    public function getDeployCommand()
    {
        return $this->getScriptingExecutable() . ' "' . $this->getFullDeployScriptPath() . '"';
    }

    /**
     * Gets the directory path of the project
     *
     * @return string
     */
    public function getDirectoryPath()
    {
        return dirname($this->path);
    }

    /**
     * Gets the path to the deploy configuration file.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Gets the unique identifier for the project.
     *
     * @return string
     */
    public function getIdentifier()
    {
        return md5($this->path);
    }
}