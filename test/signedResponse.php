<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);
date_default_timezone_set('America/Montevideo');

require_once 'vendor/autoload.php';

use Plexo\Sdk;


$auth = new Sdk\Message\Authorization([
    'Action' => (Sdk\Type\ActionType::SELECT_INSTRUMENT | Sdk\Type\ActionType::REGISTER_INSTRUMENT),
    'Type' => Sdk\Type\AuthorizationType::ANONYMOUS,
    'MetaReference' => '123456',
    'RedirectUri' => 'http://plexo.bros.me/retorno.php',
]);
$signedRequest = new Sdk\SignedRequest($auth);
var_dump($signedRequest);

unset($signedRequest);
echo "\n------------------------------------------------------------------------\n\n";

$signedRequest = new Sdk\SignedRequest([
    'Action' => (Sdk\Type\ActionType::SELECT_INSTRUMENT | Sdk\Type\ActionType::REGISTER_INSTRUMENT),
    'Type' => Sdk\Type\AuthorizationType::ANONYMOUS,
    'MetaReference' => '123456',
    'RedirectUri' => 'http://plexo.bros.me/retorno.php',
]);
var_dump($signedRequest);

?>
