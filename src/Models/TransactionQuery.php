<?php
namespace Plexo\Sdk\Models;

class TransactionQuery extends ModelsBase
{
    /**
     *
     * @var string
     */
    public $client;

    /**
     *
     * @var array List<Query>
     */
    public $Queries = [];

    /**
     *
     * @var array List<TransactionOrder>
     */
    public $Order = [];

    /**
     *
     * @var int 
     */
    public $Limit = 20;
    
    /**
     *
     * @var int 
     */
    public $Skip = 0;

    /**
     * 
     * @param array $data
     */
    public function __construct(array $data = null)
    {
        if ($data) {
            if (array_key_exists('Queries', $data)) {
                $this->Queries = array_map(function ($item) {
                    return Query::fromArray($item);
                }, $data['Queries']);
            }
            if (array_key_exists('Order', $data)) {
                $this->Order = array_map(function ($item) {
                    return TransactionOrder::fromArray($item);
                }, $data['Order']);
            }
            if (array_key_exists('Limit', $data)) {
                $this->Limit = $data['Limit'];
            }
            if (array_key_exists('Skip', $data)) {
                $this->Skip = $data['Skip'];
            }
        }
    }
    
    public function toArray($canonize = false)
    {
        $data = [
            'Limit'   => $this->Limit,
            'Order' => array_map(function ($item) {
                return $item->toArray();
            }, $this->Order),
            'Queries' => array_map(function ($item) {
                return $item->toArray();
            }, $this->Queries),
            'Skip'    => $this->Skip,
        ];
        return $data;
    }
}
