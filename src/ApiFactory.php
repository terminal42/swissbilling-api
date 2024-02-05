<?php

declare(strict_types=1);

namespace Terminal42\SwissbillingApi;

use Terminal42\SwissbillingApi\Exception\SoapException;
use Terminal42\SwissbillingApi\Soap\ApiV2;
use Terminal42\SwissbillingApi\Soap\ApiV3;

class ApiFactory
{
    public function __construct(private readonly bool $production = true)
    {
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
