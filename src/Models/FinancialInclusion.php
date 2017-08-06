<?php
namespace Plexo\Sdk\Models;

class FinancialInclusion {
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
     * @param int $type
     * @param float $taxedAmount
     * @param float $billedAmount
     * @param int $invoiceNumber
     */
    public function __construct($type, $taxedAmount, $billedAmount, $invoiceNumber) {
        $this->Type = $type;
        $this->TaxedAmount = $taxedAmount;
        $this->BilledAmount = $billedAmount;
        $this->InvoiceNumber = $invoiceNumber;
    }
}
