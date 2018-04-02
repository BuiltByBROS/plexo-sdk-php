<?php
namespace Plexo\Sdk\Models;

class IssuerInfo
{
    /**
     *
     * @var string
     */
    public $Id;

    /**
     *
     * @var int
     */
    public $IssuerId;

    /**
     *
     * @var int
     */
    public $VariationId;

    /**
     *
     * @var string
     */
    public $Issuer;

    /**
     *
     * @var string
     */
    public $Bank;

    /**
     *
     * @var string
     */
    public $Variation;

    /**
     *
     * @var string
     */
    public $ImageUrl;

    /**
     *
     * @var bool
     */
    public $MayHaveAsyncPayments;

    /**
     *
     * @var bool
     */
    public $SupportsReserve;

    /**
     *
     * @var bool
     */
    public $MayHavePaymentsLimits;

    /**
     *
     * @var array List<FieldInfo>
     */
    public $Fields;
}
