<?php

require 'core.php';

// Render the default page.
echo getTwig()->render('index.html.twig', [
    'navActive' => 0,
    'authenticated' => getAuthenticator()->isAuthenticated(),
]);
