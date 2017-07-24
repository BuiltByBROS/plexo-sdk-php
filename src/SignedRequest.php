<?php
namespace Plexo\Sdk;

class SignedRequest
{
    protected $message;
    private $fingerprint;
    private $signature;
    private $utcUnixTimeExpiration;

    private $clientName;

    public function __construct(Message $message)
    {
        $this->message = $message;
        $this->clientName = 'Sodexo';//FIXME
    }

    public function to_array()
    {
        return [
            'Object' => [
                'Fingerprint' => strtoupper($this->fingerprint),
                'Object' => [
                    'Client' => $this->clientName,
                    'Request' => $this->message->toArray(),
                ],
                'UTCUnixTimeExpiration' => $this->utcUnixTimeExpiration,//(time() + 600),
            ],
            'Signature' => $this->signature,
        ];
    }
    
    public function sign($expirationTime = null, $cert_filename = null, $cert_passphrase = null)
    {
        
        $this->utcUnixTimeExpiration = (time() + 600);
        if ($cert_passphrase === null) {
            $cert_passphrase = $_ENV['PLEXO_CREDENTIALS_PFX_PASSPHRASE'];
        }
        $cert = Certificate\Certificate::fromPfxFile($_ENV['PLEXO_CREDENTIALS_PFX_FILENAME'], $cert_passphrase);
        
        if (!openssl_pkcs12_read(file_get_contents($_ENV['PLEXO_CREDENTIALS_PFX_FILENAME']), $certs, $cert_passphrase)) {
            throw new Exception('No fue posible abrir el certificado.');// FIXME
        }
        $x509 = openssl_x509_read($certs['cert']);
        $this->fingerprint = openssl_x509_fingerprint($x509, 'sha1');
//        $data['Object']['Fingerprint'] = strtoupper($fingerprint);
        $payload_arr = [
            'Object' => [
                'Fingerprint' => strtoupper($this->fingerprint),
                'Object' => [
                    'Client' => $this->clientName,
                    'Request' => $this->message->toArray(),
                ],
                'UTCUnixTimeExpiration' => $this->utcUnixTimeExpiration,
            ],
        ];

        ksort($payload_arr['Object']);
$payload_str = str_replace('\/', '/', json_encode($payload_arr['Object']));
        openssl_sign($payload_str, $signature, $certs['pkey'], OPENSSL_ALGO_SHA512);
        $this->signature = base64_encode($signature);
    }

    /*
{
    "Object": {
        "Fingerprint": "78C4707910D3D225B2B4FAB1DD02753C4629209D",
        "Object": {
            "Client": "Nombre-Cliente",
            "Request": {
                "ClientReferenceId": "72352",
                "CurrencyId": 1,
                "FinancialInclusion": {
                    "BilledAmount": 100,
                    "InvoiceNumber": 10019,
                    "TaxedAmount": 100,
                    "Type": 0
                },
                "Installments": 3,
                "Items": [
                    {
                        "Amount": 100,
                        "ClientItemReferenceId": "12345"
                    }
                ],
                "PaymentInstrumentInput": {
                    "InstrumentToken": "d3052dd3810044d9a4091bd5281157b2"
                }
            }
        },
        "UTCUnixTimeExpiration": 1498584094
    },
    "Signature": "eAovrOQ4bj94eDX2/GqXXkm9DlTJRrFnpikJarIyPgJW67YL0ROWOWZgZ17+/RAsvGgL4o9/BuGTcDLFGFrQFGlt8lDfzbA30P/Kq3RoiGmU9bfvMItuwEcID0hw6DYep+voYPhhYllTqYmnUAZ+MboDt0Taf0Gj7TLsWjOptUdwZaxVRrVAJ7kNr9jM6nkLWKakK15jDGrlHaT8LFRBtvdl1cTr8rI6fQDNfgUnrg1DesgkgDy5n8wemnJVnC4ulV2iMYSbGElBm927ApFDD9FmTwoXJRM+6WgfbdIcWF3grpeVVLI85rLkex23+TP2MTsk47ZbxKOiLBawaOWhzvgzp3T6ScqNp26pcBJIPIzpTVElpqgWCktXvzhmC0asAZkkE/gy9qy6Mpin9DEklburTdbeM8bDplknopByBt9qenFlLkOTf//X/5ACrzPq4bNe6Na/ocrv7BRH23xNmCys2kVOuJVNs9GShIBn6uiUEM7m2nc0asqO6ksFSnOY5X8kxyFBxeQpxAiX6jpujxKpPBhXEN3IgsVQdZvbNM+TBZqUqDfkLP1nRB3NIz1UJNwPbZH5r8NuIJm4o3PoPSZlbMP7ujRMoUcS9WJPBYR2oPmepWI22ib/twDkOt+MuQLn94uDXfKt9B1la77EqHikzgpJJmiNPNpx5cijWPQ="
}
*/
}
