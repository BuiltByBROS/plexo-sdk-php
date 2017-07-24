<?php
namespace Plexo\Sdk\Models;

class PaymentInstrumentInput
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
    public $UseExtendedClientCreditIfAvailable;
}