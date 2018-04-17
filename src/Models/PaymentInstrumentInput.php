<?php
namespace Plexo\Sdk\Models;

use Plexo\Sdk\Type;

class PaymentInstrumentInput extends ModelsBase
{
    /**
     * @var string 
     */
    public $InstrumentToken;
    
    /**
     * @var Dictionary<FieldType,string>
     */
    public $NonStorableItems;

    /**
     * @var bool (required)
     */
    public $UseExtendedClientCreditIfAvailable = false;

    protected $data = [
        'InstrumentToken' => null,
        'NonStorableItems' => [],
        'UseExtendedClientCreditIfAvailable' => false,
    ];

    /**
     * @param array $params
     */
    public function __construct(array $params = []) {
        foreach ($params as $k => $v) {
            $this->{$k} = $v;
        }
    }

    public function addNonStorableItems($value, $k = null)
    {
        array_push($this->data['NonStorableItems'], ($value instanceof Type\FieldType ? $value : new Type\FieldType($k, $value)));
        return $this;
    }

    public function setNonStorableItems(array $value)
    {
        $this->data['NonStorableItems'] = [];
        foreach ($value as $k => $item) {
            $this->addNonStorableItems($item, $k);
        }
        return $this;
    }

    public function nonStorableItemsToArray()
    {
        $hash = [];
        foreach ($this->data['NonStorableItems'] as $item) {
            $hash[$item->getParamName()] = $item->getValue();
        }
        ksort($hash);
        return $hash;
    }

    public function toArray()
    {
        return [
            'InstrumentToken' => $this->data['InstrumentToken'],
            'NonStorableItems' => $this->nonStorableItemsToArray(),
            'UseExtendedClientCreditIfAvailable' => $this->data['UseExtendedClientCreditIfAvailable'],
        ];
    }
}