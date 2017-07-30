<?php
namespace Plexo\Sdk\Certificate;

class Certificate {
    public $fingerprint;
    public $cert;
    public $pkey;
    
    /**
     *
     * @param string $cert
     * @param string $pkey
     * @param string $fingerprint
     */
    public function __construct($cert = null, $pkey = null, $fingerprint = null)
    {
        $this->cert = $cert;
        $this->pkey = $pkey;
        $this->fingerprint = is_string($fingerprint) ? strtoupper($fingerprint) : null;
    }

    public static function fromServerPublicKey($key, $fingerprint = null)
    {
        $cert = sprintf("-----BEGIN CERTIFICATE-----\n%s\n-----END CERTIFICATE-----\n", trim(chunk_split($key, 64, "\n")));
        return new self($cert, $fingerprint);
    }
    
    public static function fromPfxFile($filename, $passphrase)
    {
        if (!file_exists($filename)) {
            throw new \Plexo\Sdk\Exception\CertificateException(sprintf('No existe el archivo %s.', $filename), \Plexo\Sdk\ResultCode::SYSTEM_ERROR);
        }
        if (!is_readable($filename)) {
            throw new \Plexo\Sdk\Exception\CertificateException(sprintf('El archivo %s no puede ser abierto para lectura.', $filename), \Plexo\Sdk\ResultCode::SYSTEM_ERROR);
        }
        if (!openssl_pkcs12_read(file_get_contents($filename), $certs, $passphrase)) {
            throw new \Plexo\Sdk\Exception\CertificateException(sprintf('No fue posible leer el certificado del archivo %s.', $filename), \Plexo\Sdk\ResultCode::SYSTEM_ERROR);
        }
        return new self($certs['cert'], $certs['pkey']);
    }
    
    public function getFingerprint($name)
    {
        if ($name === 'fingerprint' && is_null($this->fingerprint) && $this->cert) {
            $x509 = openssl_x509_read($this->cert);
            $this->fingerprint = openssl_x509_fingerprint($x509, 'sha1');
        }
        return $this->{$name};
    }
}
