<?php
namespace Plexo\Sdk\Message;

use Plexo\Sdk;

class CancelRequest extends Sdk\Message
{
    /**
     *
     * @var string
     */
    public $client;

    /**
     * @var float $Amount
     * @var PaymentInstrumentInput $PaymentInstrumentInput
     * @var string $TransactionId
     */
    
    protected $data = [
        'Amount' => null,
        'PaymentInstrumentInput' => null,
        'TransactionId' => null,
    ];

    public function toArray($canonize = false)
    {
//        $scheme = self::getValidationMetadata();
        $arr = $this->to_array();
        if ($canonize && !is_null($arr['Amount'])) {
            $arr['Amount'] = sprintf('float(%.1f)', $arr['Amount']);
        }
        //return array_filter($this->data, function ($v, $k) use ($scheme) {
        //    return ($scheme[$k]['required'] && !is_null($v));
        //}, ARRAY_FILTER_USE_BOTH);
        //        $scheme = self::getValidationMetadata();
        $data = [
            'Client' => $this->client,
            'Request' => $arr,
        ];
        return $data;
    }
}
