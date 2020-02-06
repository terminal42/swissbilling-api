<?php

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

    /**
     * @inheritDoc
     */
    public function __construct(\SoapFault $previous, \SoapClient $client = null)
    {
        parent::__construct($previous->getMessage(), $previous->getCode(), $previous);
        $this->SoapFault($previous->faultcode, $previous->faultstring, $previous->faultactor, $previous->detail, $previous->faultname, $previous->headerfault);

        if (null !== $client) {
            $this->lastRequest = $client->__getLastRequest();
            $this->lastRequestHeaders = $client->__getLastRequestHeaders();
            $this->lastResponse = $client->__getLastResponse();
            $this->lastResponseHeaders = $client->__getLastResponseHeaders();
            $this->functions = $client->__getFunctions();
            $this->types = $client->__getTypes();
        }
    }

    public function getLastRequest(): ?string
    {
        return $this->lastRequest;
    }

    public function getLastRequestHeaders(): ?string
    {
        return $this->lastRequestHeaders;
    }

    public function getLastResponse(): ?string
    {
        return $this->lastResponse;
    }

    public function getLastResponseHeaders(): ?string
    {
        return $this->lastResponseHeaders;
    }

    public function getFunctions(): ?array
    {
        return $this->functions;
    }

    public function getTypes(): ?array
    {
        return $this->types;
    }
}
