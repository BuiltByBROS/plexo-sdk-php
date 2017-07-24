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
    public type GetSupportedIssuers( )
    public type Purchase ( array $payment )
    public type Cancel ( array $cancel )
    public array GetServerPublicKey ( string $fingerprint )
}
```

### Métodos

Existen tres métodos de interacción. Todos serán realizados desde el servidor y WEB o aplicación del comercio.

#### Autorización

El llamado a este servicio WEB se hace desde el servidor del comercio y es el primer paso que se debe dar para interactuar con Plexo,
obteniendo como resultado una sesión de usuario.

public *\\stdClass* **Plexo\\Sdk\\Client::Authorize** ( *array* $auth )

**$auth** *array*

  * **AuthorizationType** int Las opciones son:
    * Plexo\\Sdk\\Type\\AuthorizationType::CLIENT_REFERENCE
    * Plexo\\Sdk\\Type\\AuthorizationType::OAUTH
    * Plexo\\Sdk\\Type\\AuthorizationType::ANONYMOUS
  * **MetaReference** (string) Si el tipo de autorización no es anónima, debe pasarse el tipo de referencia - ejemplo ID de usuario - para que podamos identificar el usuario.
  * **ActionType** (int) Máscara de bits, las opciones son:
    * **Plexo\\Sdk\\Type\\ActionType::SELECT_INSTRUMENT** Si se envía, se despliega la lista de medios de pago registrados por el cliente.
    * **Plexo\\Sdk\\Type\\ActionType::REGISTER_INSTRUMENT** Si se envía, se muestra el form para la captura de los datos del medio de pago a registrar.
    * **Plexo\\Sdk\\Type\\ActionType::DELETE_INSTRUMENT** Si se envía, en la lista de medios de pago disponibles se habilita la opción de borrar.
    * **Plexo\\Sdk\\Type\\ActionType::SESSION_EXTEND_AMOUNT**
    * **Plexo\\Sdk\\Type\\ActionType::CLIENT_EXTEND_AMOUNT**
  * **RedirectUri** (string) URL donde se va a redirigir al cliente web luego de finalizar el caso de uso.
  * **OptionalMetadata** *opcional* En este campo se puede guardar cualquier información que se quiera recibir en el callback y evitar mantenerlo en sesión.
  * **ClientInformation** *opcional* (array) Es un diccionario de datos que se guarda en la base de datos para uso futuro. La idea es guardar datos para autocompletar formularios, donde se solicite por ejemplo el email, dirección, número y tipo de documento, etc. Los valores se definen en https://github.com/plexouy/Plexo.Models/blob/master/FieldType.cs
  * **LimitIssuers** *opcional* Si se envía, se despliega solamente la lista de medios de pago indicados en este campo (4=MasterCard, 11=VISA, 15=OCA. Solicitar la lista en ISecurePaymentGateway.GetSupportedIssuers(ClientSignedRequest creq)).
  * **PromotionInfoIssuers** *opcional* Permite que el cliente notifique de promociones particulares para una combinación de Sello/Banco/Tipo de tarjeta.
  * **ExtendableInstrumentToken** (opcional) Se utiliza en casos que el Instrumento permita solicitar ampliación de crédito (por el momento solo Midinero).

### Realizar pago y/o guardar token
  * **ClientReferenceId** (string) Referencia de la transacción para trazabilidad de vuestro lado
  * **CurrencyId** (int) Código de moneda de la compra (1-Peso, 2-Dolar, 3-Argentino, 4-Euro, 5-Real)
  * **FinancialInclusion** (FinancialInclusion) Campo para enviar información sobre la Ley de Inclusión Financiera, que contiene:
    * BilledAmount : monto total de la compra
    * InvoiceNumber: número de factura
    * TaxedAmount : monto de la compra que tiene impuestos
    * Type: tipo de Ley que aplica: 0: No aplica, 1: Ley 17934, 6: Ley 19210.
  * **Installments** (int) Cantidad de cuotas
  * **Items** (List<Item>) Es una lista con los ítems de la compra, que contiene los siguientes campos:
    * Amount : monto del item
    * ClientItemReferenceId : ID del item
  * **PaymentInstrumentInput** (PaymentInstrumentInput) Contiene fundamentalmente el InstrumentToken y una lista de valores opcionales (como el CCV, si es requerido) que deben mandarse según los requerimientos del proveedor de medio de pago. Para la etapa de testing esto no es importante.
  * **OptionalPointOfSale** *opcional* (string) Por defecto para cada cliente se define un código de comercio por cada medio de pago, pero hay casos donde el comercio es una plataforma que ofrece servicios a múltiples comercios. Para especificar a qué comercio se le debe adjudicar la transacción, se utiliza este campo opcional.
  * **OptionalMetadata** *opcional* (string)
