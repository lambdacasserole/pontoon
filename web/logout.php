<?php

require 'core.php';

// Set security headers.
setSecurityHeaders();

// Remove login cookie.
getAuthenticator()->logout();

// Redirect to login page.
redirectToLoginPage();
