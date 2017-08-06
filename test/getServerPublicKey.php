<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);
date_default_timezone_set('America/Montevideo');

require_once 'vendor/autoload.php';

use Plexo\Sdk;

$client = new Sdk\Client();
$response = $client->GetServerPublicKey('AEA4D5C586983A140F8B566EA81901E8BD8F8C9F');

$cert = Sdk\Certificate\Certificate::fromServerPublicKey($response['Key'], $response['Fingerprint']);
//var_dump($response, $cert);
var_dump($cert);
print_r($cert);

?>
