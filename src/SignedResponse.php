<?php
namespace Plexo\Sdk;

class SignedResponse extends SignedMessage
{
    private $ResultCode;
    private $Response;
    private $ErrorMessage;

    /**
     * 
     * @param (string|array|\Plexo\Sdk\Exception\PlexoException) $response
     */
    public function __construct($response)
    {
        $this->object = $response;
//        $this->ResultCode = $response['Object']['Object']['ResultCode'];
//        if ($this->ResultCode === 0) {
//            $this->Response = $response['Object']['Object']['Response'];
//        } else {
//            $this->ErrorMessage = $response['Object']['Object']['ErrorMessage'];
//        }
//        $this->signature = $response['Signature'];
//        $this->fingerprint = $response['Object']['Fingerprint'];
//        $this->utcUnixTimeExpiration = $response['Object']['UTCUnixTimeExpiration'];
    }
    
    public function getFingerprint()
    {
        return $this->Fingerprint;
    }
    
    public function getResponse()
    {
        return $this->Response;
    }

//    public function verify(Certificate\Certificate $cert)
//    {
//        if ($this->UTCUnixTimeExpiration < time()) {
//            throw new Exception\MessageExpiredException();
//        }
//        $object = [
//            'Object' => [
//                'ResultCode' => $this->ResultCode,
//            ],
//            'Fingerprint' => $this->Fingerprint,
//            'UTCUnixTimeExpiration' => $this->UTCUnixTimeExpiration,
//        ];
//        if ($this->ResultCode === 0) {
//            $object['Object']['Response'] = $this->Response;
//            if (is_array($object['Object']['Response'])) {
//                ksort($object['Object']['Response'], SORT_REGULAR);
//            }
//        } else {
//            $object['Object']['ErrorMessage'] = $this->ErrorMessage;
//        }
//        ksort($object['Object'], SORT_REGULAR);
//        $response = str_replace('\/', '/', json_encode($object));
//        if (!openssl_verify($response, base64_decode($this->Signature), $cert->cert, OPENSSL_ALGO_SHA512)) {
//            throw new Exception\SignatureException();
//        }
//        return true; 
//    }
}
