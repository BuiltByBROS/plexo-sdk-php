# Cancel

> public *string* **Plexo\\Sdk\\Client::Cancel** ( *array* $payment )

## Ejemplo

```php
<?php
// Require the Composer autoloader.
require_once 'vendor/autoload.php';

use Plexo\Sdk;

$client = new Sdk\Client();

try {
    $response = $client->Cancel([
        'TransactionId' => 'abc123',
        'PaymentInstrumentInput' => new Sdk\Models\PaymentInstrumentInput([
            'InstrumentToken' => 'd3052dd3810044d9a4091bd5281157b2'
        ]),
        'Amount' => 100
    ]);
} catch (Sdk\Exception\PlexoException $exc) {
    printf("[%s] (%d) %s\n", get_class($exc), $exc->getCode(), $exc->getMessage());
}

```
