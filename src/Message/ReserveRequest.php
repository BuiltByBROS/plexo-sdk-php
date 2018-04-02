<?php
namespace Plexo\Sdk\Message;

use Plexo\Sdk;

class ReserveRequest extends Sdk\Message
{
    /**
     * @var array List<TimeLimit> $AdditionalRequirements
     * @var int $AnonInstrumentUsageTimeLimit
     * @var array List<AmountLimit> $CreditLimits
     * @var int $ExpirationUTC
     * @var long $InstrumentExpirationUTC
     * @var array Dictionary<FieldType,string> $InstrumentInformation
     * @var string $InstrumentToken
     * @var IssuerInfo $Issuer
     * @var string $Name
     * @var string $SessionCreationId
     * @var CardStatus $Status
     * @var array List<Currency> $SupportedCurrencies
     */

    protected $data = [
        'AdditionalRequirements' => null,
        'AnonInstrumentUsageTimeLimit' => null,
        'CreditLimits' => null,
        'ExpirationUTC' => null,
        'InstrumentExpirationUTC' => null,
        'InstrumentInformation' => null,
        'InstrumentToken' => null,
        'Issuer' => null,
        'Name' => null,
        'SessionCreationId' => null,
        'Status' => 0,
        'SupportedCurrencies' => null,
    ];

    public function toArray($canonize = false)
    {
        $arr = $this->data;
//        $data = [
//            'Client' => $this->client,
//            'Request' => $arr,
//        ];
        return [
            'AdditionalRequirements' => array_map(function ($item) {
                return ($item instanceof Sdk\Models\TimeLimit) ? $item->toArray() : $item;
            }, $this->data['AdditionalRequirements']),
            'AnonInstrumentUsageTimeLimit' => $this->data['AnonInstrumentUsageTimeLimit'],
            'CreditLimits' => $this->data['CreditLimits'],
            'ExpirationUTC' => $this->data['ExpirationUTC'],
            'InstrumentExpirationUTC' => $this->data['InstrumentExpirationUTC'],
            'InstrumentInformation' => $this->data['InstrumentInformation'],
            'InstrumentToken' => $this->data['InstrumentToken'],
            'Issuer' => $this->data['Issuer'],
            'Name' => $this->data['Name'],
            'SessionCreationId' => $this->data['SessionCreationId'],
            'Status' => $this->data['Status'],
            'SupportedCurrencies' => $this->data['SupportedCurrencies'],
        ];
    }
}
