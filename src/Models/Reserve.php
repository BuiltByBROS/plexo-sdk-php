<?php
namespace Plexo\Sdk\Models;

class Reserve extends ModelsBase
{
    /**
     * @var bool $Commit
     * @var int $Type Plexo\Sdk\Type\ReferenceType::*
     * @var string $MetaReference
     */
    
    protected $data = [
        'Commit' => null,
        'MetaReference' => null,
        'Type' => 0,
    ];

    public static function getValidationMetadata()
    {
        return [
            'Commit' => [
                'type' => 'bool',
                'required' => false,
            ],
            'Type' => [
                'type' => 'int',
                'required' => false,
            ],
            'MetaReference' => [
                'type' => 'string',
                'required' => false,
            ],
        ];
    }

//    public function toArray($canonize = false)
//    {
//        $arr = $canonize
//            ? [
//                'Commit' => $this->data['Commit'],
//                'MetaReference' => $this->data['MetaReference'],
//                'Type' => $this->data['Type'],
//            ]
//            : [
//                'Commit' => $this->data['Commit'],
//                'MetaReference' => $this->data['MetaReference'],
//                'Type' => $this->data['Type'],
//            ];
//        return $arr;
//    }
}
