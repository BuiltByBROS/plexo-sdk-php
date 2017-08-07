<?php
namespace Plexo\Sdk\Message;

use Plexo\Sdk;

class PaymentRequest extends Sdk\Message
{
    /**
     *
     * @var string
     */
    public $client;

    /**
     * @var string $ClientReferenceId
     * @var PaymentInstrumentInput $PaymentInstrumentInput
     * @var List<Item> $Items
     * @var int $CurrencyId
     * @var int $Installments
     * @var FinancialInclusion $FinancialInclusion
     * @var float $TipAmount
     * @var string $OptionalPointOfSale
     * @var string $OptionalMetadata
     */
    
    protected $data = [
        'ClientReferenceId' => null,
        'CurrencyId' => null,
        'FinancialInclusion' => null,
        'Installments' => null,
        'Items' => null,
        'OptionalMetadata' => null,
        'OptionalPointOfSale' => null,
        'PaymentInstrumentInput' => null,
        'TipAmount' => null,
    ];

//    public static function loadValidatorMetadata(\Symfony\Component\Validator\Mapping\ClassMetadata $metadata)
//    {
//        
//    }
    
    public static function getValidationMetadata()
    {
        return [
            'ClientReferenceId' => [
                'type' => 'string',
                'required' => true,
            ],
            'PaymentInstrumentInput' => [
                'type' => 'PaymentInstrumentInput',
                'required' => true,
            ],
            'Items' => [
                'type' => 'List<Item>',
                'required' => true,
            ],
            'CurrencyId' => [
                'type' => 'int',
                'required' => true,
            ],
            'Installments' => [
                'type' => 'int',
                'required' => true,
            ],
            'FinancialInclusion' => [
                'type' => 'FinancialInclusion',
                'required' => true,
            ],
            'TipAmount' => [
                'type' => 'float',
                'required' => true,
            ],
            'OptionalPointOfSale' => [
                'type' => 'string',
                'required' => true,
            ],
            'OptionalMetadata' => [
                'type' => 'string',
                'required' => true,
            ],
        ];
    }

    public function toArray()
    {
        $scheme = self::getValidationMetadata();
        $data = $this->to_array();
        foreach ($scheme as $k => $v) {
            if ($v['type'] === 'float') {
                if (!is_null($data[$k])) {
                    $data[$k] = sprintf('float(%f)', $data[$k]);
                }
            }
        }
        //return array_filter($this->data, function ($v, $k) use ($scheme) {
        //    return ($scheme[$k]['required'] && !is_null($v));
        //}, ARRAY_FILTER_USE_BOTH);
        //        $scheme = self::getValidationMetadata();
        $data = [
            'Client' => $this->client,
            'Request' => $this->to_array(),
        ];
        return $data;
    }
}
