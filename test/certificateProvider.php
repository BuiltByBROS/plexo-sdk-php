<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);
date_default_timezone_set('America/Montevideo');

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Plexo\Sdk;

class MyStore implements Sdk\Certificate\CertificateProviderInterface
{
    private $db;
    
    public function __construct()
    {
        $this->db = new PDO('mysql:dbname=plexo;host=localhost', 'plexo', 'plexo');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getByFingerprint($fingerprint)
    {
        $stmt = $this->db->prepare("SELECT HEX(fingerprint) AS fingerprint, pubkey AS cert, privkey AS pkey FROM certificates WHERE fingerprint = UNHEX(?)");
        $stmt->setFetchMode(PDO::FETCH_CLASS, '\\Plexo\\Sdk\\Certificate\\Certificate');
        $stmt->bindParam(1, $fingerprint, PDO::PARAM_STR);
        $stmt->execute();
        $cert = $stmt->fetch();
        $stmt->closeCursor();
        return $cert;
    }

    public function save(Sdk\Certificate\Certificate $certificate)
    {
        $stmt = $this->db->prepare("INSERT INTO certificates (fingerprint, pubkey, privkey) VALUES (:fingerprint, :pubkey, :privkey)");
        $stmt->execute(array(
            ':fingerprint' => hex2bin($certificate->fingerprint),
            ':pubkey' => $certificate->cert,
            ':privkey' => $certificate->pkey
        ));
        $stmt->closeCursor();
    }
}

$store = new MyStore();
Sdk\Registry::add($store, 'CertificateProvider');

$provider = Sdk\Registry::get('CertificateProvider');

$cert = new Sdk\Certificate\Certificate();
$cert->fingerprint = '423D86F25E0A7573A0D38290B7345901D9E3D090';
$cert->setBase64Cert('MIIEvDCCAqSgAwIBAgIQAOhxN/cQ+fBU1r1IJKBkxzANBgkqhkiG9w0BAQ0FADAZMRcwFQYDVQQDDA5zb2RleG8yNzA0MjAxNzAgFw0xNzA0MjcxNjIyMTFaGA8yMTE3MDQyNzE2MjIxMVowGTEXMBUGA1UEAwwOc29kZXhvMjcwNDIwMTcwggIiMA0GCSqGSIb3DQEBAQUAA4ICDwAwggIKAoICAQDTXiGF+oiLPASNoDE6u0MQszutUhaX7rReft3+l6xwxWBIV3vNEisO9A0RbAFZ6vHieksk9peAhzKpK/fGvSpp47eBn+V6RHPqwmv/3MV8aPLRNHM4nQjqWhy0+zksHswSrI+Vi5mFPAP57KDzDrjPnBg1Z0DelxR30xh1+XKO5ZskfE5vdZEmKFqoQjsmydJxBvbvuqxWZxL6z1VExcWLHq9WRzmO6V3zyGn+p3rnhEYLVlIrh4LrsTFMIhXxijkXwn7MizO7H9YugV5D5ZTkqQKt+qUSMYpPpYYWxRO9/WP1coPxfCaFZGpvAY1JHPRAlFqH8x+pUXo0AKhZFD7PflFqWnpAChmyHmWnmuQ5IL90EwcbPBvqE1R5HBiCbfGnrgRzW6MH1XmjdpD66XzOua1SSlrHf1cfE/Xtsgn2W+3p6+Ml3Ki6fHC+N3ythstHHb1ZGsJu7OwytzHVw63Fu/cZ8Nf0sdFM6p/Wl/1t0WMcrkYJ0VPaiNGvSFHwoWIiMLlrWl/qrw4+sSvQWcaQZNgMIDWc34EpnhIZyROAYAtKntAJ1If4w4Y/RFw6y/3SHHfbMBCYj0PKS3/H86lyqv/HVu/aBH+0FxzarvokpAY99oGYSegSIYwnXzRyVUyzg7Ao+rvKiKWiDuNOnlQrgcui0tQdjQAKltTNKcjfgQIDAQABMA0GCSqGSIb3DQEBDQUAA4ICAQBlbkDcLAP2dPRZt+IOTlcyDzwWF8cemgg+iVGswglRAiN+UKfftaMoVjDbqxaJeq4HkCOoJrX9HT/P7szFhG0roR4rdr34bjQLvEkQlgKOm7HOpa8pwhUwscEULsR/DNIiJAu+MYF6mVhdm7/X3ISiREuBO76D4ZYdhor3Elx7ZbXXhn2aS7zo6lu4/IDyaljQ8BcoWQtJgyxTf5napUfGgxDSsmPIIf9TqhCNv7wnLB4XnW8dHADt06zPsAoR2W+6wLD9TaYw/WRRGBx6FG+rgRBQsaFTVcKu+myFVWKVFZii3w8RGDT9UwyMCAajPBX0eMS1SHWHz5IvdojPzNxsHcPgzadKNjChZ+mROmgh5pUBFYfqac4SjPEly6sYD7mGBmnCyZon1V0c8HqSPVrdNKgWGA//y7qjqkLsJ2LkDSUh0BCO09P8zy7+jbtRqEjd+x6sWTok/OAZbko+qN8RPn20Fd46VMtlTSnK3G7+HDLQHGDu+NnMuH1mm6autoAfPYKOuA3Wa3e6kih6ZfW69npafN2c0gk0ZTDpGPAp0jhqAwUo00deT7zVYMHk+0qPRruWaJmH1ru+C4RLqA8agvK4VgXZbwXfdVy1Op64Xblop9Z4VAIIrYQxZPuaelJTS+XiWlWwGVFjtU+lhnAqFfr3KmW9rQh69oYbKm1Jsw==');
$cert->setBase64Pkey('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');
$provider->save($cert);

var_dump($provider->getByFingerprint('423D86F25E0A7573A0D38290B7345901D9E3D090'));

exit;
$certificateStore = Sdk\Registry::contains('CertificateProvider')
    ? Sdk\Registry::get('CertificateProvider')
    : Sdk\Certificate\CertificateProvider::instance();
var_dump($certificateStore);


$certStore = new MyStore();
Sdk\Registry::add($certStore, 'CertificateProvider');

$certificateStore = Sdk\Registry::contains('CertificateProvider')
    ? Sdk\Registry::get('CertificateProvider')
    : Sdk\Certificate\CertificateProvider::instance();
var_dump($certificateStore);

?>
