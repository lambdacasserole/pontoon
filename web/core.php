<?php

use Minim\Authenticator;
use Minim\Configuration;
use Pontoon\DeployConfiguration;
use Pontoon\GlobalConfiguration;

require __DIR__ . '/../vendor/autoload.php';

/**
 * Gets the authenticator for the application.
 *
 * @return Authenticator
 */
function getAuthenticator()
{
    $config = new Configuration(__DIR__ . '/../security.yml');
    return new Authenticator($config);
}

/**
 * Gets the global configuration settings for the application.
 *
 * @return GlobalConfiguration
 */
function getGlobalConfiguration()
{
    return new GlobalConfiguration('/../config.yml');
}

/**
 * Gets an array of valid deploy target directory paths.
 *
 * @return DeployConfiguration[]
 */
function getDeployTargets()
{
    // Get configuration.
    $config = getGlobalConfiguration();
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
 * Gets a handle on the Twig template engine for the application.
 *
 * @return Twig_Environment
 */
function getTwig()
{
    $loader = new Twig_Loader_Filesystem(__DIR__ . '/../templates');
    return new Twig_Environment($loader, []);
}

/**
 * Redirects to the specified URL and terminates execution.
 *
 * @param string $url   the URL to redirect to
 */
function redirect($url)
{
    header("Location: $url");
    die();
}

/**
 * Redirects the client to the deployments page.
 */
function redirectToDeployPage()
{
    redirect('deploy.php');
}

/**
 * Redirects the client to the login page.
 */
function redirectToLoginPage()
{
    redirect('login.php');
}

/**
 * Redirects the client to the login page if they're not authenticated.
 */
function protectPage()
{
    if (!getAuthenticator()->isAuthenticated())
    {
        redirectToLoginPage();
    }
}
