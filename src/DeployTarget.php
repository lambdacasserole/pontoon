<?php

namespace Pontoon;

use Spyc;

/**
 * Represents a configuration file for a specific deploy target.
 *
 * @author Saul Johnson
 * @since 13/07/2015
 */
class DeployTarget
{
    /**
     * The raw associative array that underlies this class
     *
     * @var array
     */
    private $config;

    /**
     * The path to the deploy configuration file.
     *
     * @var string  path to the deploy configuration file
     */
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
     * @return string the project name
     */
    public function getProjectName()
    {
        return $this->config['project_name'];
    }

    /**
     * Gets the project description.
     *
     * @return string the project description
     */
    public function getDescription()
    {
        return $this->config['description'];
    }

    /**
     * Gets whether or not deployment of this project is enabled.
     *
     * @return bool true if deployment of this project is enabled, otherwise false
     */
    public function isDeployEnabled()
    {
        return $this->config['deploy_enabled'];
    }

    /**
     * Gets the filename of the deploy script for this project.
     *
     * @return string the filename of the deploy script for this project
     */
    public function getDeployScript()
    {
        return $this->config['deploy_script'];
    }

    /**
     * Gets the full path of the deploy script for this project.
     *
     * @return string the full path of the deploy script for this project
     */
    public function getFullDeployScriptPath()
    {
        return $this->getDirectoryPath() . '/' . $this->getDeployScript();
    }

    /**
     * Gets the name of the scripting executable to use to execute the deploy script.
     *
     * @return string the name of the scripting executable to use to execute the deploy script
     */
    public function getScriptingExecutable()
    {
        return $this->config['scripting_exe'];
    }

    /**
     * Gets the command needed to run the deploy script.
     *
     * @return string the command needed to run the deploy script
     */
    public function getDeployCommand()
    {
        return $this->getScriptingExecutable() . ' "' . $this->getFullDeployScriptPath() . '"';
    }

    /**
     * Gets the directory path of the project.
     *
     * @return string the directory path of the project
     */
    public function getDirectoryPath()
    {
        return dirname($this->path);
    }

    /**
     * Gets the path to the deploy configuration file.
     *
     * @return string the path to the deploy configuration file
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Gets the unique identifier for the project.
     *
     * @return string the unique identifier for the project
     */
    public function getIdentifier()
    {
        return md5($this->path);
    }
}
