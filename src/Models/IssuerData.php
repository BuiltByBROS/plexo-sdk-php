<?php
namespace Plexo\Sdk\Models;

class IssuerData extends ModelsBase
{
    /**
     *
     * @var int 
     */
//    public $IssuerId;
    
    /**
     *
     * @var int 
     */
//    public $CommerceId;
    
//    Dictionary<FieldType,string> 
    /**
     *
     * @var array 
     */
//    public $Metadata;

    protected $data = [
        'IssuerId' => null,
        'CommerceId' => null,
        'Metadata' => null,
    ];

    public function setIssuerId($value)
    {
        if (is_scalar($value) && is_numeric($value)) {
            $this->data['IssuerId'] = (int) $value;
        }
        return $this;
    }
}
