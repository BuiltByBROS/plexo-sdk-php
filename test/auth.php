<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);
date_default_timezone_set('America/Montevideo');

require_once 'vendor/autoload.php';

use Plexo\Sdk;
use Plexo\Sdk\Type;

//$auth = new Sdk\Message\Authorization([
//    'Action' => (Type\ActionType::SELECT_INSTRUMENT | Type\ActionType::REGISTER_INSTRUMENT),
//    'Type' => Type\AuthorizationType::ANONYMOUS,
//    'MetaReference' => "123456",
//    'RedirectUri' => 'http://www.sitiocliente.com/plexo/XXX/YYY',
//]);
//$signedRequest = new Sdk\SignedRequest($auth);
//$signedRequest->sign();
//var_dump($signedRequest, $signedRequest->to_array());


$client = new Sdk\Client();

$response = $client->Authorize([
    'Action' => (Type\ActionType::SELECT_INSTRUMENT | Type\ActionType::REGISTER_INSTRUMENT),
    'Type' => Type\AuthorizationType::ANONYMOUS,
    'MetaReference' => '123456',
    'RedirectUri' => 'http://plexo.bros.me/retorno.php',
]);

//var_dump($response);
printf("http://testing.plexo.com.uy/plexoweb/Instruments/Chose?sessionid=%s\n", $response);

?>
