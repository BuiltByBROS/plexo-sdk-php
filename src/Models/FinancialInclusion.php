<?php
namespace Plexo\Sdk\Models;

class FinancialInclusion implements PlexoModelInterface
{
    /**
     * @var float
     */
    public $BilledAmount;

    /**
     *
     * @var int 
     */

    public $InvoiceNumber;
    /**
     * @var float
     */
    public $TaxedAmount;

    /**
     * @var int One of \Plexo\Sdk\Type\InclusionType
     */
    public $Type;

    /**
     * 
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        foreach ($params as $k => $v) {
            $this->{$k} = $v;
        }
    }
    
    public function toArray()
    {
        return [
            'BilledAmount'  => is_null($this->BilledAmount)  ? null : sprintf('float(%.1f)', $this->BilledAmount),//(float) $this->BilledAmount,
            'InvoiceNumber' => is_null($this->InvoiceNumber) ? null : (int) $this->InvoiceNumber,
            'TaxedAmount'   => is_null($this->TaxedAmount)   ? null : sprintf('float(%.1f)', $this->TaxedAmount),//(float) $this->TaxedAmount,
            'Type'          => is_null($this->Type)          ? null : (int) $this->Type,
        ];
    }
}
