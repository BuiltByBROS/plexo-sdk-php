<?php
namespace Plexo\Sdk\Models;

class CreateBankInstrumentRequest extends ModelsBase
{
    /**
     *
     * @var int
     */
    public $IssuerId;

    /**
     *
     * @var Plexo\Sdk\Models\AuthorizationInfo
     */
    public $User;
     
    /**
     *
     * @var array Dictionary<FieldType, string>
     */
    public $InstrumentData = [];

    public function setUser($value) {
        $this->User = $value instanceof AuthorizationInfo ? $value : AuthorizationInfo::fromArray($value);
    }

    public function toArray($canonize = false)
    {
        $data = [
//            'Client' => $this->client,
//            'Request' => [
                'InstrumentData' => $this->InstrumentData,
                'IssuerId' => $this->IssuerId,
                'User' => $this->User->toArray(),
//            ],
        ];
        return $data;
    }
}
