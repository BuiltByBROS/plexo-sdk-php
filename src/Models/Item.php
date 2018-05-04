<?php
namespace Plexo\Sdk\Models;

class Item extends ModelsBase// implements PlexoModelInterface
{
    /**
     *
     * @var float
     */
    // public $Amount;
    
    /**
     *
     * @var string
     */
    // public $ClientItemReferenceId;

    /**
     *
     * @var array List<InfoLine> 
     */
    // public $InfoLines;

    /**
     *
     * @var string 
     */
    // public $MetaData;

    /**
     *
     * @var array List<string> 
     */
    // public $Tags;

    protected $data = [
        'Amount' => null,
        'ClientItemReferenceId' => null,
        'InfoLines' => null,
        'MetaData' => null,
        'Tags' => null,
    ];

    /**
     * 
     * @param array $params
     */
    public function __construct(array $params = []) {
        foreach ($params as $k => $v) {
            $this->data[$k] = $v;
        }
    }

    public static function getValidationMetadata()
    {
        return [
            'Amount' => [
                'type' => 'float',
                'required' => true,
            ],
            'ClientItemReferenceId' => [
                'type' => 'string',
                'required' => false,
            ],
            'InfoLines' => [
                'type' => 'array',
                'required' => false,
            ],
            'MetaData' => [
                'type' => 'string',
                'required' => false,
            ],
            'Tags' => [
                'type' => 'array',
                'required' => false,
            ],
        ];
    }

    public function toArray($canonize = false)
    {
        return [
            'Amount'                => is_null($this->Amount) ? null : ($canonize ? sprintf('float(%s)', (float) $this->Amount) : (float) $this->Amount),
            'ClientItemReferenceId' => $this->ClientItemReferenceId,
            'InfoLines'             => $this->InfoLines,
            'MetaData'              => $this->MetaData,
            'Tags'                  => $this->Tags,
        ];
    }
}
