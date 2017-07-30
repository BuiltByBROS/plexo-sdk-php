<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);
date_default_timezone_set('America/Montevideo');

require_once 'vendor/autoload.php';

use Plexo\Sdk\Certificate;

$cert = Certificate\Certificate::fromPfxFile($_ENV['PLEXO_CREDENTIALS_PFX_FILENAME'], $_ENV['PLEXO_CREDENTIALS_PFX_PASSPHRASE']);
var_dump($cert);
var_dump($cert->fingerprint);

?>
