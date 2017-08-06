<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);
date_default_timezone_set('America/Montevideo');

require_once 'vendor/autoload.php';

use Plexo\Sdk;
use Plexo\Sdk\Type;


class MyStore implements Sdk\Certificate\CertificateProviderInterface
{
    private static $c = 0;

    public function getByFingerprint($fingerprint)
    {
        if ($fingerprint != '423D86F25E0A7573A0D38290B7345901D9E3D090') {
            return false;
        }
        $pkey = '-----BEGIN PRIVATE KEY-----
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
9WVXDK8y40VjbgN1+AhbPXoVrA==
-----END PRIVATE KEY-----';
        return new Sdk\Certificate\Certificate(null, $pkey, $fingerprint);
    }

    public function save(Sdk\Certificate\Certificate $certificate)
    {
        printf("\nsave %d\n", ++self::$c);
    }
}

$store = new MyStore();

// Registrar la clase
Sdk\Registry::add($store, 'CertificateProvider');



$i = 0;

//printf("\n%d %s\n", ++$i, 'variables de entorno');
//try {
//    $client = new Sdk\Client();
//    $response = $client->Authorize([
//        'Action' => (Type\ActionType::SELECT_INSTRUMENT | Type\ActionType::REGISTER_INSTRUMENT),
//        'Type' => Type\AuthorizationType::ANONYMOUS,
//        'MetaReference' => '123456',
//        'RedirectUri' => 'http://plexo.bros.me/retorno.php',
//    ]);
//    printf("http://testing.plexo.com.uy/plexoweb/Instruments/Chose?sessionid=%s\n", $response);
//} catch (Exception $exc) {
//    printf("[%s] (%s) %s %s:%d\n", get_class($exc), $exc->getCode(), $exc->getMessage(), $exc->getFile(), $exc->getLine());
//}

//printf("\n%d %s\n", ++$i, 'otro cliente');
//try {
//    $client = new Sdk\Client([
//        'client' => 'soyotro',
//    ]);
//    $response = $client->Authorize([
//        'Action' => (Type\ActionType::SELECT_INSTRUMENT | Type\ActionType::REGISTER_INSTRUMENT),
//        'Type' => Type\AuthorizationType::ANONYMOUS,
//        'MetaReference' => '123456',
//        'RedirectUri' => 'http://plexo.bros.me/retorno.php',
//    ]);
//    printf("http://testing.plexo.com.uy/plexoweb/Instruments/Chose?sessionid=%s\n", $response);
//} catch (Exception $exc) {
//    printf("[%s] (%s) %s %s:%d\n", get_class($exc), $exc->getCode(), $exc->getMessage(), $exc->getFile(), $exc->getLine());
//}

printf("\n%d %s\n", ++$i, 'pem');
try {
    $client = new Sdk\Client([
        'pem_filename' => '/home/pablo/bros/plexo/sodexo.pem',
        'privkey_fingerprint' => '423D86F25E0A7573A0D38290B7345901D9E3D090'
    ]);
    $response = $client->Authorize([
        'Action' => (Type\ActionType::SELECT_INSTRUMENT | Type\ActionType::REGISTER_INSTRUMENT),
        'Type' => Type\AuthorizationType::ANONYMOUS,
        'MetaReference' => '123456',
        'RedirectUri' => 'http://plexo.bros.me/retorno.php',
    ]);
    printf("http://testing.plexo.com.uy/plexoweb/Instruments/Chose?sessionid=%s\n", $response);
} catch (Exception $exc) {
    printf("[%s] (%s) %s %s:%d\n", get_class($exc), $exc->getCode(), $exc->getMessage(), $exc->getFile(), $exc->getLine());
}

//printf("\n%d %s\n", ++$i, 'provider');
//try {
//    $client = new Sdk\Client([
//        'privkey_fingerprint' => '423D86F25E0A7573A0D38290B7345901D9E3D090'
//    ]);
//    $response = $client->Authorize([
//        'Action' => (Type\ActionType::SELECT_INSTRUMENT | Type\ActionType::REGISTER_INSTRUMENT),
//        'Type' => Type\AuthorizationType::ANONYMOUS,
//        'MetaReference' => '123456',
//        'RedirectUri' => 'http://plexo.bros.me/retorno.php',
//    ]);
//    printf("http://testing.plexo.com.uy/plexoweb/Instruments/Chose?sessionid=%s\n", $response);
//} catch (Exception $exc) {
//    printf("[%s] (%s) %s %s:%d\n", get_class($exc), $exc->getCode(), $exc->getMessage(), $exc->getFile(), $exc->getLine());
//}

?>


listo!
