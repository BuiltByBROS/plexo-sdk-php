<?php
namespace Plexo\Sdk\Models;

class IssuerData
{
    /**
     *
     * @var int 
     */
    public $IssuerId;
    
    /**
     *
     * @var int 
     */
    public $CommerceId;
    
//    Dictionary<FieldType,string> 
    /**
     *
     * @var array 
     */
    public $Metadata;

    /**
     * 
     * @param array $params
     */
    public function __construct(array $params = []) {
        foreach ($params as $k => $v) {
            $this->{$k} = $v;
        }
    }
}
