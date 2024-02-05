<?php

declare(strict_types=1);

namespace Terminal42\SwissbillingApi\Soap;

use Terminal42\SwissbillingApi\Type\InvoiceStatus;
use Terminal42\SwissbillingApi\Type\TransactionStatus;

/**
 * @method \stdClass EshopTransactionAcknowledge(array $parameters)
 * @method \stdClass EshopTransactionCancel(array $parameters)
 * @method \stdClass EshopTransactionUnCancel(array $parameters)
 * @method \stdClass EshopTransactionPreScreening(array $parameters)
 * @method \stdClass EShopTransactionCreditNote(array $parameters)
 * @method \stdClass EShopTransactionUpdate(array $parameters)
 * @method \stdClass EShopTransactionGetInvoice(array $parameters)
 */
class ApiV3 extends Api
{
    public function __construct(bool $production)
    {
        $wsdl = 'https://ws.swissbilling.ch/ws/EshopRequestV3.svc?WSDL';
        $options = ['exceptions' => true];

        if (!$production) {
            $wsdl = 'https://ws-pp.swissbilling.ch/ws/EshopRequestV3.svc?WSDL';
            $options['cache_wsdl'] = WSDL_CACHE_NONE;
            $options['trace'] = true;
        }

        $options['classmap'] = [
            'transactionstatus' => TransactionStatus::class,
            'getinvoicestatus' => InvoiceStatus::class,
        ];

        parent::__construct($wsdl, $options);
    }
}
