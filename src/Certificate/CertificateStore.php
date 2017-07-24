<?php
namespace Plexo\Sdk\Certificate;

use Plexo\Sdk\Registry;

class CertificateStore implements CertificateStoreInterface
{
    private $certificates = array();

    public static function instance() {
        $name = __CLASS__;//get_called_class();
        if (!Registry::contains($name)) {
            $instance = new self();
            Registry::add($instance, $name);
        }
        return Registry::get($name);
    }

    /**
     * 
     * @param string $fingerprint
     * @return \Plexo\Sdk\Certificate
     */
    public function get($fingerprint) {
        return array_key_exists($fingerprint, $this->certificates) ? $this->certificates[$fingerprint] : false;
    }

    /**
     * 
     * @param \Plexo\Sdk\Certificate\Certificate $cert
     * @return boolean
     */
    public function save(Certificate $cert) {
        $this->certificates[$cert->fingerprint] = $cert;
        return true;
    }

}
