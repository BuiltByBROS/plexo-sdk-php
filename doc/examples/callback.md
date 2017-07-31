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

$cert = Registry::get('CertificateProvider')
    ->getByFingerprint($signedRequest->fingerprint);

$message = $signedRequest->getMessage();
var_dump($signedRequest, $message);

try {
    $signedRequest->validate($cert);
    $signedResponse = new Sdk\SignedResponse([
        'Client' => $message['Client'],
        'ResultCode' => 0,
    ]);
} catch (Sdk\PlexoException $exc) {
    $signedResponse = new Sdk\SignedResponse($exc);
} catch (\Exception $exc) {
    $signedResponse = new Sdk\SignedResponse(new Sdk\Exception\PlexoException('Error interno.', Sdk\ResultCode::SYSTEM_ERROR));
}

$priv = Sdk\Certificate\Certificate::fromPfxFile($_ENV['PLEXO_CREDENTIALS_PFX_FILENAME'], $_ENV['PLEXO_CREDENTIALS_PFX_PASSPHRASE']);
$signedResponse->sign($priv);

header("Content-Type: application/json; charset=UTF-8");
echo $signedResponse

?>
```
