<?php

/*
 * # Login page
 *
 * The Pontoon login page. Simple one-login kinda thingy, reading the hash straight from the config. I'm not about to
 * go implementing a whole user account thing here with profiles a changeable passwords and all that jazz. One email,
 * one hashed password.
 *
 * Stay fresh and spooky,
 *
 * - Saul Johnson
 */

require 'core.php';

$status = 0;

if (Auth::isAuthenticated())
{
    redirectToDeployPage();
}

if (Request::isLoginFormSubmitted()) {
    if (Auth::authenticate(Request::getLoginEmail(), Request::getLoginPassword()))
    {
        redirectToDeployPage();
    }
    else
    {
        $status = 1;
    }
}

// Render the default page.
echo getTwig()->render('login.html.twig', [
    'status' => $status,
]);
