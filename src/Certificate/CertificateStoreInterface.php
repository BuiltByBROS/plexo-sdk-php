<?php
namespace Plexo\Sdk\Certificate;

interface CertificateStoreInterface {
    
    /**
     * 
     * @param string $fingerprint
     * @return Certificate
     */
    public function get($fingerprint);
    
    public function save(Certificate $certificate);
}
