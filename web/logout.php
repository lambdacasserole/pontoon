<?php

require 'core.php';

// Remove login cookie.
getAuthenticator()->logout();

// Redirect to login page.
redirectToLoginPage();
