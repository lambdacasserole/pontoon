<?php

require 'core.php';

// If we're already logged in, go to deploy.
if (getAuthenticator()->isAuthenticated())
{
    redirectToDeployPage();
}

// If the login form is submitted.
$status = 0;
if (\Minim\Request::isLoginFormSubmitted())
{
    if (getAuthenticator()->authenticate(\Minim\Request::getLoginEmail(), \Minim\Request::getLoginPassword()))
    {
        redirectToDeployPage(); // Authentication success.
    }
    else
    {
        $status = 1; // Bad credentials.
    }
}

// Render the default page.
echo getTwig()->render('login.html.twig', [
    'status' => $status,
]);
