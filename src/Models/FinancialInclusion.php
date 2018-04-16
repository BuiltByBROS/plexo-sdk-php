<?php
namespace Plexo\Sdk\Models;

class FinancialInclusion extends ModelsBase//implements PlexoModelInterface
{
    /**
     * @var float
     */
    public $BilledAmount = 0.0;

    /**
     *
     * @var int 
     */
    public $InvoiceNumber = 0;

    /**
     * @var float
     */
    public $TaxedAmount = 0.0;

    /**
     * @var int One of \Plexo\Sdk\Type\InclusionType
     */
    public $Type = 0;

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

    public function toArray($canonize = false)
    {
        if ($canonize) {
            return [
                'BilledAmount'  => is_null($this->BilledAmount)  ? null : sprintf('float(%s)', (float) $this->BilledAmount),
                'InvoiceNumber' => is_null($this->InvoiceNumber) ? null : (int) $this->InvoiceNumber,
                'TaxedAmount'   => is_null($this->TaxedAmount)   ? null : sprintf('float(%s)', (float) $this->TaxedAmount),
                'Type'          => is_null($this->Type)          ? null : (int) $this->Type,
            ];
        } else {
            return [
                'BilledAmount'  => is_null($this->BilledAmount)  ? null : (float) $this->BilledAmount,
                'InvoiceNumber' => is_null($this->InvoiceNumber) ? null : (int) $this->InvoiceNumber,
                'TaxedAmount'   => is_null($this->TaxedAmount)   ? null : (float) $this->TaxedAmount,
                'Type'          => is_null($this->Type)          ? null : (int) $this->Type,
            ];
        }
    }
}
