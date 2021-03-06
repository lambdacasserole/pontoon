<?php

require __DIR__ . '/../vendor/autoload.php';

use Minim\Authenticator;
use Pontoon\Services\AuthenticationService;
use Pontoon\DeployTarget;
use Pontoon\Configuration;
use Pontoon\Services\ConfigurationService;

use \Aidantwoods\SecureHeaders\SecureHeaders;

/**
 * Gets the authenticator for the application.
 *
 * @return Authenticator
 */
function getAuthenticator()
{
    return AuthenticationService::get();
}

/**
 * Gets the global configuration settings for the application.
 *
 * @return Configuration
 */
function getGlobalConfiguration()
{
    return ConfigurationService::get();
}

/**
 * Gets an array of valid deploy target directory paths.
 *
 * @return DeployTarget[]
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
            $loadedConfig = new DeployTarget($deployConfig, $config);
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
    redirect('/deploy.php');
}

/**
 * Redirects the client to the login page.
 */
function redirectToLoginPage()
{
    redirect('/');
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

/**
 * Generates and returns a nonce unique to this request.
 *
 * @return string
 */
function getNonce()
{
	if (!isset($GLOBALS['nonce']))
	{
		$GLOBALS['nonce'] = base64_encode(random_bytes(32));
	}
	return $GLOBALS['nonce'];
}

/**
 * Sets security headers in the response.
 */
function setSecurityHeaders()
{
	$headers = new SecureHeaders();
	$headers->hsts();
	$headers->csp('default', 'self');
	$headers->csp('style', 'self');
	$headers->csp('style', 'fonts.googleapis.com');
	$headers->csp('font', 'self');
	$headers->csp('font', 'fonts.gstatic.com');
	$headers->csp('style', "'nonce-" . getNonce() . "'"); // Nonce for styles.
	$headers->apply();
}
