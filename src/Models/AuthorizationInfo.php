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
