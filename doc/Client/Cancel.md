# Cancel

> public *string* **Plexo\\Sdk\\Client::Authorize** ( *array* $payment )

## Ejemplo

```php
<?php
// Require the Composer autoloader.
require_once 'vendor/autoload.php';

use Plexo\Sdk;

$client = new Sdk\Client();

try {
    $response = $client->Authorize([
        'Action' => (Type\ActionType::SELECT_INSTRUMENT | Type\ActionType::REGISTER_INSTRUMENT),
        'Type' => Type\AuthorizationType::ANONYMOUS,
        'MetaReference' => '123456',
        'RedirectUri' => 'http://www.sitiocliente.com/plexo/XXX/YYY',
    ]);
    printf("ID de sesión: %s\n", $response);
} catch (Sdk\Exception\PlexoException $exc) {
    printf("[%s] (%d) %s\n", get_class($exc), $exc->getCode(), $exc->getMessage());
}

```
