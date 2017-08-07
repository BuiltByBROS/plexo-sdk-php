# Purchase

> public *\\stdClass* **Plexo\\Sdk\\Client::Purchase** ( *array* $payment )

## Parámetros

  * **ClientReferenceId** (string)
  * **CurrencyId** (int) Código de moneda de la compra. Una de las constantes de *Plexo\\Sdk\\Type\\CurrencyType*:
    * UYU (Peso uruguayo)
    * USD (Dólar estadounidense)
    * ARS (Peso argentino)
    * EUR (Euro)
    * BRL (Real)
  * **FinancialInclusion** (FinancialInclusion) Campo para enviar información sobre la Ley de Inclusión Financiera, que contiene:
    * BilledAmount
    * InvoiceNumber
    * TaxedAmount
    * Type
  * **Installments** (int) Cantidad de cuotas
  * **Items** (List<Item>) Es una lista con los ítems de la compra, que contiene los siguientes campos:
    * Amount : monto del item
    * ClientItemReferenceId : ID del item
  * **PaymentInstrumentInput** (PaymentInstrumentInput)
  * **OptionalPointOfSale** *opcional* (string)
  * **OptionalMetadata** *opcional* (string)

## Ejemplo

```php
<?php
// Require the Composer autoloader.
require_once 'vendor/autoload.php';

use Plexo\Sdk;
use Plexo\Sdk\Type;

$client = new Sdk\Client();
try {
    $response = $client->Purchase([
        'ClientReferenceId' => '72352',
        'CurrencyId' => Type\CurrencyType::UYU,
        'FinancialInclusion' => new Sdk\Models\FinancialInclusion([
            'Type' => Type\InclusionType::NONE,
            'BilledAmount' => 100,
            'InvoiceNumber' => 10019,
            'TaxedAmount' => 100,
        ]),
        'Installments' => 3,
        'Items' => [
            new Sdk\Models\Item([
                'Amount' => 100.0,
                'ClientItemReferenceId' => '12345',
            ])
        ],
        'PaymentInstrumentInput' => new Sdk\Models\PaymentInstrumentInput([
            'InstrumentToken' => 'd3052dd3810044d9a4091bd5281157b2'
        ]),
    ]);
} catch (Sdk\Exception\PlexoException $exc) {
    printf("[%s] (%d) %s\n", get_class($exc), $exc->getCode(), $exc->getMessage());
}
```
