<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);
date_default_timezone_set('America/Montevideo');

require_once 'vendor/autoload.php';

use Plexo\Sdk;


$cert = Sdk\Certificate\Certificate::fromPfxFile($_ENV['PLEXO_CREDENTIALS_PFX_FILENAME'], $_ENV['PLEXO_CREDENTIALS_PFX_PASSPHRASE']);

$signedResponse = new Sdk\SignedResponse(new Sdk\Exception\ResultCodeException('OK', Sdk\ResultCode::OK));
$signedResponse->sign($cert);
echo $signedResponse;

unset($signedResponse);
echo "\n------------------------------------------------------------------------\n\n";

$arr = array(
  "Action" => 3,
  "Client" => "Sodexo",
  "OptionalMetadata" => null,
  "PaymentInstrument" => array(
    "AdditionalRequirements" => array(
      array(
        "RequirementAfterTimeLimit" => 0,
        "SecondsLeft" => 0,
      ),
      array(
        "RequirementAfterTimeLimit" => 1,
        "SecondsLeft" => 0,
      )
    ),
    "AnonInstrumentUsageTimeLimit" => 86400,
    "CreditLimits" => array(),
    "InstrumentExpirationUTC" => 1517356800,
    "InstrumentToken" => "90c77249395d451cb8c9cd3edd17a8cd",
    "Issuer" => array(
      "Bank" => null,
      "Id" => "11",
      "ImageUrl" => "http://209.133.212.155/plexoweb/images/instruments/11.png",
      "Issuer" => "Visa",
      "Variation" => NULL,
    ),
    "Name" => "411111XX1111",
    "Status" => 0,
    "SupportedCurrencies" => array(
      array(
        "CurrencyId" => 1,
        "Name" => "Peso",
        "Plural" => "Pesos",
        "Symbol" => "$",
      ),
      array(
        "CurrencyId" => 2,
        "Name" => "Dólar",
        "Plural" => "Dólares",
        "Symbol" => 'U$S',
      )
    )
  ),
  "SessionId" => "3976286e82bd430c90a1ece47a7b1c4d"
);

$signedResponse = new Sdk\SignedResponse($arr);
$signedResponse->sign($cert);
echo $signedResponse;

$signedResponse->validate($cert);

unset($signedResponse);
echo "\n------------------------------------------------------------------------\n\n";

$arr = [
    'Client' => "Sodexo",
    'ResultCode' => 0,
];
$signedResponse = new Sdk\SignedResponse($arr);
$signedResponse->sign($cert);
echo $signedResponse;

$signedResponse->validate($cert);

?>
