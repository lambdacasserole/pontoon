<?php

require 'core.php';

// Set security headers.
setSecurityHeaders();

// Protect page.
protectPage();

// Spit out page with deploy targets.
$targets = getDeployTargets();
echo getTwig()->render('deploy.html.twig', [
    'navActive' => 0,
    'targets' => $targets,
    'authenticated' => getAuthenticator()->isAuthenticated(),
    'nonce' => getNonce()
]);
