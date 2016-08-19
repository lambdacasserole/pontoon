<?php

require 'core.php';

// Remove login cookie.
Auth::logout();

// Redirect to home page.
header('Location: /');
die();
