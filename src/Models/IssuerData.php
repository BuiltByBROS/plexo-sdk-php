<?php
namespace Plexo\Sdk\Models;

class IssuerData extends ModelsBase
{
    /**
     * @var int $IssuerId
     * @var int $CommerceId
     * @var array $Metadata Dictionary<FieldType,string> 
     */
    protected $data = [
        'IssuerId' => null,
        'CommerceId' => null,
        'Metadata' => null,
    ];

    public static function getValidationMetadata()
    {
        return [
            'IssuerId' => [
                'type' => 'int',
                'required' => true,
            ],
            'CommerceId' => [
                'type' => 'int',
                'required' => true,
            ],
            'Metadata' => [
                'type' => 'array',
                'required' => false,
            ],
        ];
    }

    public function setIssuerId($value)
    {
        if (is_scalar($value) && is_numeric($value)) {
            $this->data['IssuerId'] = (int) $value;
        }
        return $this;
    }
}
