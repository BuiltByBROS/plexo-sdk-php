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
            if (array_key_exists('queries', $data)) {
                $this->Queries = array_map(function ($item) {
                    return new Query($item);
                }, $data['queries']);
            }
            if (array_key_exists('order', $data)) {
                $this->Order = array_map(function ($item) {
                    return new TransactionOrder($item);
                }, $data['order']);
            }
            if (array_key_exists('limit', $data)) {
                $this->Limit = $data['limit'];
            }
            if (array_key_exists('skip', $data)) {
                $this->Skip = $data['skip'];
            }
        }
    }
    
    public function toArray($canonize = false)
    {
        $data = [
            'Limit'   => $this->Limit,
//            'Order' => array_map(function ($item) {
//                    return $item->toArray();
//                }, $this->Order),
//                'Queries' => array_map(function ($item) {
//                    return $item->toArray();
//                }, $this->Queries),
            'Skip'    => $this->Skip,
        ];
        return $data;
    }
}
