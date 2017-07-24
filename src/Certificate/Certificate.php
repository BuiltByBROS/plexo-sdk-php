<?php
namespace Plexo\Sdk\Certificate;

class Certificate {
    public $fingerprint;
    public $cert;
    public $pkey;
    
    /**
     * 
     * @param string $fingerprint
     * @param string $cert
     * @param string $pkey
     */
    public function __construct($fingerprint, $cert, $pkey = null)
    {
        $this->fingerprint = strtoupper($fingerprint);
        $this->cert = $cert;
        $this->pkey = $pkey;
    }

    public static function fromKey($fingerprint, $key)
    {
        $cert = sprintf("-----BEGIN CERTIFICATE-----\n%s\n-----END CERTIFICATE-----\n", trim(chunk_split($key, 64, "\n")));
        return new self($fingerprint, $cert);
    }
    
    public static function fromPfxFile($filename, $passphrase)
    {
        if (!openssl_pkcs12_read(file_get_contents($filename), $certs, $passphrase)) {
            throw new \Plexo\Sdk\Exception\CertificateException('No fue posible abrir el certificado.');
        }
        $x509 = openssl_x509_read($certs['cert']);
        $fingerprint = openssl_x509_fingerprint($x509, 'sha1');
        return new self($fingerprint, $certs['cert'], $certs['pkey']);
    }
}
