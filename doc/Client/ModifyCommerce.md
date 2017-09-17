# ModifyCommerce

> public *array* **Plexo\\Sdk\\Client::ModifyCommerce** ( *array* $commerce )

## Ejemplo

```php
<?php
// Require the Composer autoloader.
require_once 'vendor/autoload.php';

use Plexo\Sdk;

$client = new Sdk\Client();

try {
    $response = $client->ModifyCommerce([
        'CommerceId' => 80,
        'Name' => 'Nuevo nombre'
    ]);
    print_r($response);
} catch (Sdk\Exception\PlexoException $exc) {
    printf("[%s] (%d) %s\n", get_class($exc), $exc->getCode(), $exc->getMessage());
}

```

### Imprime

```
Array
(
    [0] => Array
        (
            [CommerceId] => 9
            [Name] => Comercio A
        )

    [1] => Array
        (
            [CommerceId] => 13
            [Name] => Comercio B
        )

)
```
