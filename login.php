<?php

/*
 * # Login page
 *
 * The Pontoon login page. Simple one-login kinda thingy, reading the hash straight from the config. I'm not about to
 * go implementing a whole user account thing here with profiles and changeable passwords and all that jazz. One email,
 * one hashed password.
 *
 * Stay fresh and spooky,
 *
 * - Saul Johnson
 */

require 'core.php';

// If we're already logged in, go to deploy.
if (Auth::isAuthenticated())
{
    redirectToDeployPage();
}

// If the login form is submitted.
$status = 0;
if (Request::isLoginFormSubmitted())
{
    if (Auth::authenticate(Request::getLoginEmail(), Request::getLoginPassword()))
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
