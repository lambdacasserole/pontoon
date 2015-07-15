<?php

require 'core.php';

// Protect page.
protectPage();

$targets = getDeployTargets();

echo getTwig()->render('deploy.html.twig', [
    'navActive' => 1,
    'targets' => $targets,
    'authenticated' => Auth::isAuthenticated(),
]);