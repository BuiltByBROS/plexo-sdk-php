# Plexo SDK para PHP - Versión 0.1

**Plexo** es un repositorio de medios de pago. Su objetivo es facilitar la utilización de estos instrumentos permitiendo desacoplar toda
complejidad asociada a la integración con los medios de pago.

## Requerimientos

Para correr el SDK, su sistema debe contar con **PHP >= 5.6** compilado con el módulo openssl.

## Instalación

La manera recomendada de instalar el SDK es a través de Composer.

```bash
$ composer require plexouy/plexo-sdk
```

## Uso básico

```php
<?php
// Require the Composer autoloader.
require_once 'vendor/autoload.php';

use Plexo\Sdk;
use Plexo\Sdk\Type;

$client = new Sdk\Client();

try {
    $response = $client->Authorize([
        'Action' => (Type\ActionType::SELECT_INSTRUMENT | Type\ActionType::REGISTER_INSTRUMENT),
        'Type' => Type\AuthorizationType::ANONYMOUS,
        'MetaReference' => '123456',
        'RedirectUri' => 'http://www.sitiocliente.com/plexo/XXX/YYY',
    ]);
    var_dump($response);
    /*
     * string(32) "0e22e728c74046ce9353736c2c5bbe0b"
     */
} catch (Sdk\Exception\PlexoException $exc) {
    printf("[%s] (%d) %s\n", get_class($exc), $exc->getCode(), $exc->getMessage());
}
```

## Credenciales

La autenticación se realiza a través un nombre de usuario y verificación de firmas. Todas las peticiones son firmadas utilizando una clave privada emitida por Plexo.

El SDK utiliza las siguientes variables de entorno para la autenticación:

  * PLEXO_CREDENTIALS_CLIENT
  * PLEXO_CREDENTIALS_PFX_FILENAME
  * PLEXO_CREDENTIALS_PFX_PASSPHRASE

Si lo prefiere, en lugar de utilizar variables de entorno, puede indicar los datos de autenticación en el código:

```php
<?php
// Require the Composer autoloader.
require_once 'vendor/autoload.php';

use Plexo\Sdk;

$client = new Sdk\Client([
    'client' => 'Nombre_Cliente',
    'pfx_filename' => '~/certs/nombrecliente.pfx',
    'pfx_passphrase' => 'demotest',
]);
```

## Clase Plexo\\Sdk\\Client

### Sinopsis de la Clase

```
Plexo\Sdk\Client {
    public __construct ( [ array $options ] )
    public string Authorize ( array $auth )
    public <type> GetSupportedIssuers( )
    public <type> Purchase ( array $payment )
    public <type> Cancel ( array $cancel )
    public array GetServerPublicKey ( string $fingerprint )
}
```

### Métodos

#### Authorize

El llamado a este servicio WEB se hace desde el servidor del comercio y es el primer paso que se debe dar para interactuar con Plexo,
obteniendo como resultado una sesión de usuario.

> public *string* **Plexo\\Sdk\\Client::Authorize** ( *array* $auth )

**$auth** *array*

  * **AuthorizationType** (int) Una de las constantes de *Plexo\\Sdk\\Type\\AuthorizationType:*
    * CLIENT_REFERENCE
    * OAUTH
    * ANONYMOUS
  * **MetaReference** (string)
  * **ActionType** (int) Máscara de bits formada con las constantes de *Plexo\\Sdk\\Type\\ActionType*:
    * SELECT_INSTRUMENT
    * REGISTER_INSTRUMENT
    * DELETE_INSTRUMENT
    * SESSION_EXTEND_AMOUNT
    * CLIENT_EXTEND_AMOUNT
  * **RedirectUri** (string)
  * **OptionalMetadata** *opcional*
  * **ClientInformation** *opcional* (array)
  * **LimitIssuers** *opcional*
  * **PromotionInfoIssuers** *opcional*
  * **ExtendableInstrumentToken** (opcional)

### Purchase

> public \\stdClass Plexo\\Sdk\\Client::Purchase ( array $payment )

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
  
### GetServerPublicKey

> public *array* Plexo\\Sdk\\Client::GetServerPublicKey ( *string* $fingerprint)
