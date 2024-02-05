<?php

declare(strict_types=1);

namespace Terminal42\SwissbillingApi\Type;

/**
 * @property string $id          Identification for the merchant fournished by SWISSBILLING
 * @property string $pwd         Password fournished for SWISSBILLING
 * @property string $success_url URL of redirection for a transaction accepted by SWISSBILLING
 * @property string $cancel_url  URL of redirection for a transaction canceled by the online customer
 * @property string $error_url   URL of redirection for a transaction refused by SWISSBILLING
 */
class Merchant extends AbstractType
{
    public function __construct(string $id, string $pwd, string $success_url, string $cancel_url, string $error_url)
    {
        parent::__construct([
            'id' => $id,
            'pwd' => $pwd,
            'success_url' => $success_url,
            'cancel_url' => $cancel_url,
            'error_url' => $error_url,
        ]);
    }
}
