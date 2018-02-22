<?php
namespace Plexo\Sdk\Models;

class AuthorizationInfo extends ModelsBase
{
    /**
     *
     * @var string
     */
    public $client;

    /**
     *
     * @var int Plexo\Type\AuthorizationType::*
     */
    public $Type;

    /**
     *
     * @var string 
     */
    public $MetaReference;

    /**
     * @var string $MetaReference 
     * @var int $Type Any of the AuthorizationType constants
     */

    protected $data = [
        'MetaReference' => null,
        'Type' => null,
    ];

    public function toArray($canonize = false)
    {
        return [
            'MetaReference' => $this->MetaReference,
            'Type' => $this->Type,
        ];
//        $arr = $this->to_array();
//        $data = [
//            'Client' => $this->client,
//            'Request' => $arr,
//        ];
//        return $data;
    }
}





//{
//    "Fingerprint":"43D6A770DB74F7972051D7FF6EE5339FDA03B70E",
//    "Object":{
//        "Client":"Bros"
//        "Request":{
//            "InstrumentData":{
//                "Name":"Nombre"
//            },
//            "IssuerId":13,
//            "User":{
//                "Type":2,
//                "MetaReference":"meta reference"
//            },
//        },
//    },
//    "UTCUnixTimeExpiration":1519322701
//}
//
//{
//    "Fingerprint":"43D6A770DB74F7972051D7FF6EE5339FDA03B70E",
//    "Object":{
//        "Client":"Bros",
//        "Request":{
//            "InstrumentData":{
//                "Name":"Nombre"
//            },
//            "IssuerId":13,
//            "User":{
//                "MetaReference":"meta reference",
//                "Type":2
//            }
//        }
//    },
//    "UTCUnixTimeExpiration":1519322701
//}
