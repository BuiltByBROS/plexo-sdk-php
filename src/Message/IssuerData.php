<?php
namespace Plexo\Sdk\Message;

use Plexo\Sdk;

class IssuerData extends Sdk\Message
{
    /**
     *
     * @var string
     */
    public $client;
    
    /**
     * @var int $CommerceId
     * @var int $IssuerId
     * @var array $Metadata
     */

    protected $data = [
        'CommerceId' => null,
        'IssuerId' => null,
        'Metadata' => null,
    ];

    public function toArray($canonize = false)
    {
        $arr = array_filter($this->to_array());
//        $data = [
//            'Client' => $this->client,
//            'Request' => $arr,
//        ];
        return $arr;
    }
}
