<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);
date_default_timezone_set('America/Montevideo');

require_once 'vendor/autoload.php';

use Plexo\Sdk;


$cert = Sdk\Certificate\Certificate::fromPfxFile($_ENV['PLEXO_CREDENTIALS_PFX_FILENAME'], $_ENV['PLEXO_CREDENTIALS_PFX_PASSPHRASE']);


$auth = new Sdk\Message\Authorization([
    'Action' => (Sdk\Type\ActionType::SELECT_INSTRUMENT | Sdk\Type\ActionType::REGISTER_INSTRUMENT),
    'Type' => Sdk\Type\AuthorizationType::ANONYMOUS,
    'MetaReference' => '123456',
    'RedirectUri' => 'http://plexo.bros.me/retorno.php',
]);
$signedRequest = new Sdk\SignedRequest($auth);
$signedRequest->sign($cert);
var_dump($signedRequest->toArray());
var_dump($signedRequest->verify($cert));

unset($signedRequest);
echo "\n------------------------------------------------------------------------\n\n";

$signedRequest = new Sdk\SignedRequest([
    'Action' => (Sdk\Type\ActionType::SELECT_INSTRUMENT | Sdk\Type\ActionType::REGISTER_INSTRUMENT),
    'Type' => Sdk\Type\AuthorizationType::ANONYMOUS,
    'MetaReference' => '123456',
    'RedirectUri' => 'http://plexo.bros.me/retorno.php',
    'lalala' => null,
]);
$signedRequest->sign($cert);
$array = $signedRequest->toArray();
$json = json_encode($array);
var_dump($signedRequest, $array);
var_dump($signedRequest->verify($cert));

unset($signedRequest);
echo "\n------------------------------------------------------------------------\n\n";

$signedRequest = Sdk\SignedRequest::fromJson($json);
var_dump('signedRequest', $signedRequest);
var_dump('toArray', $signedRequest->toArray());
var_dump('verify', $signedRequest->verify($cert));

?>
