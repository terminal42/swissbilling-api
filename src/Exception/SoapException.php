<?php

declare(strict_types=1);

namespace Terminal42\SwissbillingApi\Exception;

class SoapException extends \SoapFault
{
    /**
     * @var string|null
     */
    private $lastRequest;

    /**
     * @var string|null
     */
    private $lastRequestHeaders;

    /**
     * @var string|null
     */
    private $lastResponse;

    /**
     * @var string|null
     */
    private $lastResponseHeaders;

    /**
     * @var array|null
     */
    private $functions;

    /**
     * @var array|null
     */
    private $types;

    public function __construct(\SoapFault $previous, \SoapClient|null $client = null)
    {
        parent::__construct($previous->faultcode, $previous->faultstring, $previous->faultactor, $previous->detail, $previous->faultname, $previous->headerfault);

        if (null !== $client) {
            $this->lastRequest = $client->__getLastRequest();
            $this->lastRequestHeaders = $client->__getLastRequestHeaders();
            $this->lastResponse = $client->__getLastResponse();
            $this->lastResponseHeaders = $client->__getLastResponseHeaders();
            $this->functions = $client->__getFunctions();
            $this->types = $client->__getTypes();
        }
    }

    public function getLastRequest(): string|null
    {
        return $this->lastRequest;
    }

    public function getLastRequestHeaders(): string|null
    {
        return $this->lastRequestHeaders;
    }

    public function getLastResponse(): string|null
    {
        return $this->lastResponse;
    }

    public function getLastResponseHeaders(): string|null
    {
        return $this->lastResponseHeaders;
    }

    public function getFunctions(): array|null
    {
        return $this->functions;
    }

    public function getTypes(): array|null
    {
        return $this->types;
    }
}
