<?php

session_start();
define('DOCROOT', getcwd().DIRECTORY_SEPARATOR);
require 'system/HappyPuppy.php';
require('settings/routes.php');
require 'settings/database.php';
include_dir('views/helpers/*.php');

run();

?>
