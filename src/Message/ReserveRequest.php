<?php
namespace Plexo\Sdk\Message;

use Plexo\Sdk;

class ReserveRequest extends Sdk\Message
{
    /**
     *
     * @var string
     */
    public $client;

    /**
     * @var List<TimeLimit> $AdditionalRequirements
     * @var int $AnonInstrumentUsageTimeLimit
     * @var List<AmountLimit> $CreditLimits
     * @var int $ExpirationUTC
     * @var long $InstrumentExpirationUTC
     * @var Dictionary<FieldType,string> $InstrumentInformation
     * @var string $InstrumentToken
     * @var IssuerInfo $Issuer
     * @var string $Name
     * @var string $SessionCreationId
     * @var CardStatus $Status
     * @var List<Currency> $SupportedCurrencies
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
        $arr = $this->to_array();
        $data = [
            'Client' => $this->client,
            'Request' => $arr,
        ];
        return $data;
    }
}
