<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);
date_default_timezone_set('America/Montevideo');

require_once 'vendor/autoload.php';

use Plexo\Sdk;

$client = new Sdk\Client('Nombre-Cliente');

$response = $client->GetSupportedIssuers();

var_dump($response);


?>

