<?php

namespace Terminal42\SwissbillingApi;

use Terminal42\SwissbillingApi\Exception\SoapException;
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
     * @throws SoapException
     */
    public function createV2(): ApiV2
    {
        try {
            return new ApiV2($this->production);
        } catch (\SoapFault $e) {
            throw new SoapException($e);
        }
    }

    /**
     * @throws SoapException
     */
    public function createV3(): ApiV3
    {
        try {
            return new ApiV3($this->production);
        } catch (\SoapFault $e) {
            throw new SoapException($e);
        }
    }
}
