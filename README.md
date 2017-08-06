# Plexo SDK para PHP - Versión 0.1

**Plexo** es un repositorio de medios de pago. Su objetivo es facilitar la utilización de estos instrumentos permitiendo desacoplar toda
complejidad asociada a la integración con los medios de pago.

## Requerimientos

Para correr el SDK, su sistema debe contar con **PHP >= 5.6** compilado con el módulo openssl.

## Primeros pasos

* Obtener nombre de usuario y certificado emitido por Plexo.
* Instalar el SDK.

## Instalación

La manera recomendada de instalar el SDK es a través de Composer.

```bash
$ composer require plexouy/plexo-sdk
```

## Certificados

El cliente puede desarrollar y registrar su propia clase de almacenamiento de certificados. Esta clase debe implementar la interfaz *[Plexo\\Sdk\\Certificate\\CertificateStoreInterface](src/Certificate/CertificateProviderInterface.php)*.

De esta manera se evitará la realización de peticiones adicionales a la API, dándole al cliente la libertad de optar por el modo y lugar de almacenamiento más conveniente para él (base de datos, sistema de archivos, APIs, etc).

[Ver ejemplo](doc/CertificateProvider/example.md)

## Credenciales

La autenticación se realiza a través un nombre de usuario y verificación de firmas. Todas las peticiones son firmadas utilizando una clave privada emitida por Plexo.

El SDK utiliza las siguientes variables de entorno para la autenticación:

  * PLEXO_CREDENTIALS_CLIENT
  * PLEXO_CREDENTIALS_PRIVKEY
  * PLEXO_CREDENTIALS_PRIVKEY_FINGERPRINT
  
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
    'privkey' => [
        'pfx_filename' => '~/certs/nombrecliente.pfx',
        'pfx_passphrase' => 'demotest',
    ],
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

**Plexo\\Sdk\\Client**
* [Authorize](doc/Client/Authorize.md)
* [GetSupportedIssuers](doc/Client/GetSupportedIssuers.md)
* [Purchase](doc/Client/Purchase.md)
* [Cancel](doc/Client/Cancel.md)
* [GetServerPublicKey](doc/Client/GetServerPublicKey.md)
