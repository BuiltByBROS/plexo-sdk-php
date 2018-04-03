<?php
namespace Plexo\Sdk\Models;

class Commerce
{
    /**
     * @var int $CommerceId
     */
    public $CommerceId;

    /**
     * @var int $Name
     */
    public $Name;

    /**
     * 
     * @param array $params
     */
    public function __construct(array $params = []) {
        foreach ($params as $k => $v) {
            $this->{$k} = $v;
        }
    }
}
