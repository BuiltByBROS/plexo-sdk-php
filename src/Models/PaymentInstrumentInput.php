<?php
namespace Plexo\Sdk\Models;

class PaymentInstrumentInput implements PlexoModelInterface
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
     * @var bool
     */
    public $UseExtendedClientCreditIfAvailable = false;

    /**
     * @param array $params
     */
    public function __construct(array $params = []) {
        foreach ($params as $k => $v) {
            $this->{$k} = $v;
        }
    }

    public function toArray()
    {
        return [
            'InstrumentToken'                    => $this->InstrumentToken,
            'NonStorableItems'                   => $this->NonStorableItems,
            'UseExtendedClientCreditIfAvailable' => $this->UseExtendedClientCreditIfAvailable,
        ];
    }
}