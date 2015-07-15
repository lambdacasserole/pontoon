<?php

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

    public function __construct($path)
    {
        $this->path = $path;
        $this->config = Spyc::YAMLLoad($path);
    }

    public function getProjectName()
    {
        return $this->config['project_name'];
    }

    public function getDescription()
    {
        return $this->config['description'];
    }

    public function isDeployEnabled()
    {
        return $this->config['deploy_enabled'];
    }

    public function getDeployScript()
    {
        return $this->config['deploy_script'];
    }

    public function getFullDeployScriptPath()
    {
        return $this->getDirectoryPath() . '/' . $this->getDeployScript();
    }

    public function getDirectoryPath()
    {
        return dirname($this->path);
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getIdentifier()
    {
        return md5($this->path);
    }
}