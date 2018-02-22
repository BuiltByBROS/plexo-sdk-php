<?php
namespace Plexo\Sdk\Models;

class PaymentRequest extends ModelsBase
{
    /**
     * @var string $ClientReferenceId
     * @var PaymentInstrumentInput $PaymentInstrumentInput
     * @var List<Item> $Items
     * @var int $CurrencyId
     * @var int $Installments
     * @var FinancialInclusion $FinancialInclusion
     * @var float $TipAmount
     * @var int $OptionalCommerceId
     * @var string $OptionalMetadata
     */
    
    protected $data = [
        'ClientReferenceId' => null,
        'CurrencyId' => null,
        'FinancialInclusion' => null,
        'Installments' => null,
        'Items' => null,
        'OptionalCommerceId' => null,
        'OptionalMetadata' => null,
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
            'OptionalCommerceId' => [
                'type' => 'int',
                'required' => false,
            ],
            'OptionalMetadata' => [
                'type' => 'string',
                'required' => true,
            ],
        ];
    }

    public static function fromArray($data)
    {
        $inst = new self();
        foreach ($data as $k => $v) {
            $k = ucfirst($k);
            $setter = 'set'.$k;
            if (method_exists($inst, $setter)) {
                call_user_func([$inst, $setter], $v);
            } else {
                $inst->data[$k] = $v;
            }
        }
        return $inst;
    }

    public function toArray($canonize = false)
    {
//        $scheme = self::getValidationMetadata();
        $arr = $this->data;
        if ($canonize) {
            if (!is_null($arr['TipAmount'])) {
                $arr['TipAmount'] = sprintf('float(%.1f)', $arr['TipAmount']);
            }
        }
        //return array_filter($this->data, function ($v, $k) use ($scheme) {
        //    return ($scheme[$k]['required'] && !is_null($v));
        //}, ARRAY_FILTER_USE_BOTH);
        //        $scheme = self::getValidationMetadata();
//        $data = [
//            'Client' => $this->client,
//            'Request' => $arr,
//        ];
        return $arr;
    }
}
