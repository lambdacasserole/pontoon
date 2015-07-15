<?php

require 'core.php';

Auth::logout();

header('Location: index.php');
die();