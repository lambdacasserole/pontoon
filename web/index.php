<?php

require 'core.php';

use Minim\Request;

// If we're already logged in, go to deploy.
if (getAuthenticator()->isAuthenticated())
{
    redirectToDeployPage();
}

// If the login form is submitted.
$status = 0;
if (Request::isLoginFormSubmitted())
{
    if (getAuthenticator()->authenticate(Request::getLoginEmail(), Request::getLoginPassword()))
    {
        redirectToDeployPage(); // Authentication success.
    }
    else
    {
        $status = 1; // Bad credentials.
    }
}

// Render the default page.
echo getTwig()->render('index.html.twig', [
    'status' => $status,
]);
