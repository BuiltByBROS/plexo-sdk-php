<?php
namespace Plexo\Sdk\Models;

class Item extends ModelsBase// implements PlexoModelInterface
{
    /**
     *
     * @var float
     */
    public $Amount;
    
    /**
     *
     * @var string
     */
    public $ClientItemReferenceId;

    /**
     *
     * @var array List<InfoLine> 
     */
    public $InfoLines;

    /**
     *
     * @var string 
     */
    public $MetaData;

    /**
     *
     * @var array List<string> 
     */
    public $Tags;

    /**
     * 
     * @param array $params
     */
    public function __construct(array $params = []) {
        foreach ($params as $k => $v) {
            $this->{$k} = $v;
        }
    }

    public function toArray($canonize = false)
    {
        return [
            'Amount'                => is_null($this->Amount) ? null : ($canonize ? sprintf('float(%s)', $this->Amount) : (float) $this->Amount),
            'ClientItemReferenceId' => $this->ClientItemReferenceId,
            'InfoLines'             => $this->InfoLines,
            'MetaData'              => $this->MetaData,
            'Tags'                  => $this->Tags,
        ];
    }
}
