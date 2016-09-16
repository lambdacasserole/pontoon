<?php

require 'core.php';

// Remove login cookie.
getAuthenticator()->logout();

// Redirect to home page.
header('Location: /');
die();
