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

## Certificados

> Plexo\\Sdk\\Certificate\\CertificateStoreInterface

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

**Plexo\\Sdk\\Client**
* [Authorize](doc/Client/Authorize.md)
* [GetSupportedIssuers](doc/Client/GetSupportedIssuers.md)
* [Purchase](doc/Client/Purchase.md)
* [Cancel](doc/Client/Cancel.md)
* [GetServerPublicKey](doc/Client/GetServerPublicKey.md)
