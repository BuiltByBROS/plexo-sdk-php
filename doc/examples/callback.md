# Recibiendo peticiones callback

## Ejemplo

```php
<?php

require_once 'vendor/autoload.php';

use Plexo\Sdk;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Content-Type: text/plain; charset=UTF-8");
    header("Allow: POST", true, 405);
    echo "Method Not Allowed.\n";
    exit;
}

// Obtener cuerpo de la petición (JSON).
$data = '';
$fp = fopen("php://input", "r");
while(!feof($fp)) {
    $data .= fgets($fp);
}
fclose($fp);

$signedRequest = Sdk\SignedRequest::fromJson($data);

$message = $signedRequest->getMessage();

try {
    $signedRequest->validate();
    $signedResponse = new Sdk\SignedResponse([
        'Client' => $message['Client'],
        'ResultCode' => 0,
    ]);
} catch (Sdk\PlexoException $exc) {
    $signedResponse = new Sdk\SignedResponse($exc);
} catch (\Exception $exc) {
    $signedResponse = new Sdk\SignedResponse(new Sdk\Exception\PlexoException('Error interno.', Sdk\ResultCode::SYSTEM_ERROR));
}

$certificateProvider = MyCertStore();
$priv = $certificateProvider->getSigningCert();
$signedResponse->sign($priv);

header("Content-Type: application/json; charset=UTF-8");
echo $signedResponse

?>
```
