<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);
date_default_timezone_set('America/Montevideo');

require_once 'vendor/autoload.php';

use Plexo\Sdk;

$certificateStore = Sdk\Registry::contains('CertificateProvider')
    ? Sdk\Registry::get('CertificateProvider')
    : Sdk\Certificate\CertificateProvider::instance();
var_dump($certificateStore);

class MyStore
{
    
}

$certStore = new MyStore();
Sdk\Registry::add($certStore, 'CertificateProvider');

$certificateStore = Sdk\Registry::contains('CertificateProvider')
    ? Sdk\Registry::get('CertificateProvider')
    : Sdk\Certificate\CertificateProvider::instance();
var_dump($certificateStore);

?>
