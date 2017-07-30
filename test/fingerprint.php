<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);
date_default_timezone_set('America/Montevideo');

require_once 'vendor/autoload.php';

use Plexo\Sdk;

$cert_filename = $_ENV['PLEXO_CREDENTIALS_PFX_FILENAME'];
$passphrase = $_ENV['PLEXO_CREDENTIALS_PFX_PASSPHRASE'];
if (!openssl_pkcs12_read(file_get_contents($cert_filename), $certs, $passphrase)) {
    throw new Exception('No fue posible abrir el certificado.');
}
$x509 = openssl_x509_read($certs['cert']);
$fingerprint = openssl_x509_fingerprint($x509, 'sha1');

printf("Fingerprint: %s\n", strtoupper($fingerprint));

$client = new Sdk\Client('Nombre-Cliente');

print_r($client->GetServerPublicKey(strtoupper($fingerprint)));

?>
