<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../libs/Configuration.php';
require __DIR__ . '/../libs/DeployConfiguration.php';
require __DIR__ . '/../libs/Request.php';
require __DIR__ . '/../libs/Auth.php';

/**
 * Gets the configuration class for the application.
 *
 * @return Configuration
 */
function getConfiguration()
{
    return Configuration::get();
}

/**
 * Gets an array of valid deploy target directory paths.
 *
 * @return DeployConfiguration[]
 */
function getDeployTargets()
{
    // Get configuration.
    $config = getConfiguration();
    $dir = $config->getRootPath();
    $script = $config->getDeployConfigName();

    // Filter for valid deploy targets.
    $targets = [];
    $contents = scandir($dir);
    foreach ($contents as $file)
    {
        $path = $dir . '/' . $file;
        $deployConfig = $path . '/' . $script;
        if ($file[0] != '.' && is_dir($path) && file_exists($deployConfig))
        {
            $loadedConfig = new DeployConfiguration($deployConfig);
            if ($loadedConfig->isDeployEnabled())
            {
                $targets[] = $loadedConfig;
            }
        }
    }

    return $targets;
}

/**
 * Gets a handle on the twig templating engine for the application.
 *
 * @return Twig_Environment
 */
function getTwig()
{
    $loader = new Twig_Loader_Filesystem(__DIR__ . '/../templates');
    return new Twig_Environment($loader, []);
}

/**
 * Redirects the client to the deployments page.
 */
function redirectToDeployPage()
{
    header("Location: deploy.php");
    die();
}

/**
 * Redirects the client to the login page.
 */
function redirectToLoginPage()
{
    header("Location: login.php");
    die();
}

/**
 * Redirects the client to the login page if they're not authenticated.
 */
function protectPage()
{
    if (!Auth::isAuthenticated())
    {
        redirectToLoginPage();
    }
}
