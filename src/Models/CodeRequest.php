<?php
namespace Plexo\Sdk\Models;

class CodeRequest extends ModelsBase
{
    const CODE_ACTION_QUERY           = 0;
    const CODE_ACTION_PAY             = 1;
    const CODE_ACTION_DENY            = 2;
    const CODE_ACTION_END_CANCELATION = 3;

    /**
     *
     * @var string
     */
    public $Code;

    /**
     *
     * @var int
     */
    public $Action = self::CODE_ACTION_QUERY;

    public function toArray()
    {
        $data = [
            'Client' => $this->client,
            'Request' => [
                'Action' => $this->Action,
                'Code' => $this->Code,
            ],
        ];
        return $data;
    }
}
