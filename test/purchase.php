<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);
date_default_timezone_set('America/Montevideo');

require_once 'vendor/autoload.php';

use Plexo\Sdk;
use Plexo\Sdk\Type;

$client = new Sdk\Client();

try {
    $response = $client->Purchase([
        'ClientReferenceId' => 'abc',
    //    PaymentInstrumentInput $PaymentInstrumentInput
    //    List<Item> $Items
        'CurrencyId' => Type\CurrencyType::BRL,
        'Installments' => 5,
        'FinancialInclusion' => new Sdk\Models\FinancialInclusion(Type\InclusionType::NONE, 0.21, 6.5, 987654321),
        'TipAmount' => 4.5,
    //    string $OptionalPointOfSale
    //    string $OptionalMetadata    
    ]);
} catch (Sdk\Exception\PlexoException $exc) {
    printf("[%s] (%d) %s\n", get_class($exc), $exc->getCode(), $exc->getMessage());
}

//var_dump($response);

function is_FinancialInclusion() {
    return true;
}

?>

