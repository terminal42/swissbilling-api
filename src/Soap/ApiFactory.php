<?php

namespace Terminal42\SwissbillingApi;

use Terminal42\SwissbillingApi\Soap\ApiV2;
use Terminal42\SwissbillingApi\Soap\ApiV3;

class ApiFactory
{
    /**
     * @var bool
     */
    private $production;

    public function __construct(bool $production = true)
    {
        $this->production = $production;
    }

    /**
     * @throws \SoapFault
     */
    public function createV2(): ApiV2
    {
        return new ApiV2($this->production);
    }

    /**
     * @throws \SoapFault
     */
    public function createV3(): ApiV3
    {
        return new ApiV3($this->production);
    }
}
