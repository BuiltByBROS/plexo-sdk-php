<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);
date_default_timezone_set('America/Montevideo');

require_once dirname(__DIR__).'/vendor/autoload.php';

use Plexo\Sdk\Exception;

$exc = new Exception\CertificateException('certificate');
var_dump($exc);

$exc = new Exception\ConfigurationException('configuration');
var_dump($exc);

$exc = new Exception\FingerprintException('fingerprint');
var_dump($exc);

$exc = new Exception\HttpClientException('http');
var_dump($exc);

$exc = new Exception\MessageExpiredException('messageExpired');
var_dump($exc);

$exc = new Exception\PlexoException('base');
var_dump($exc);

$exc = new Exception\ResultCodeException('resultCode');
var_dump($exc);

$exc = new Exception\SignatureException('signature');
var_dump($exc);


?>

Listo
