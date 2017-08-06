<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);
date_default_timezone_set('America/Montevideo');

require_once 'vendor/autoload.php';

var_dump(getenv('PLEXO_CREDENTIALS_CLIENT'));
var_dump(getenv('OTRO'));

?>
