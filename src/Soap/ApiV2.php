<?php

namespace Terminal42\SwissbillingApi\Soap;

use Terminal42\SwissbillingApi\Type\CheckResult;
use Terminal42\SwissbillingApi\Type\DateTime;
use Terminal42\SwissbillingApi\Type\Debtor;
use Terminal42\SwissbillingApi\Type\InvoiceItem;
use Terminal42\SwissbillingApi\Type\Merchant;
use Terminal42\SwissbillingApi\Type\OrderItem;
use Terminal42\SwissbillingApi\Type\Transaction;
use Terminal42\SwissbillingApi\Type\TransactionStatus;

/**
 * @method TransactionStatus EshopTransactionRequest(Merchant $merchant, Transaction $transaction, Debtor $debtor, integer $count, InvoiceItem[] $items)
 * @method TransactionStatus EshopTransactionDirect(Merchant $merchant, Transaction $transaction, Debtor $debtor, integer $count, InvoiceItem[] $items)
 * @method TransactionStatus EshopTransactionByPass(Merchant $merchant, Transaction $transaction, Debtor $debtor, integer $count, InvoiceItem[] $items)
 * @method TransactionStatus EshopTransactionCancel(Merchant $merchant, string $transaction_ref, DateTime $order_timestamp)
 * @method TransactionStatus EshopTransactionAcknowledge(Merchant $merchant, string $transaction_ref, DateTime $order_timestamp)
 * @method TransactionStatus EshopTransactionConfirmation(Merchant $merchant, string $transaction_ref, DateTime $order_timestamp)
 * @method TransactionStatus EshopTransactionStatusRequest(Merchant $merchant, string $transaction_ref, DateTime $order_timestamp)
 * @method TransactionStatus EshopCreditNotification(Merchant $request, string $transaction_ref, DateTime $order_timestamp, float $amount)
 * @method CheckResult EshopTransactionCheck(Merchant $request, DateTime $startdate, DateTime $enddate, string $status)
 */
class ApiV2 extends Api
{
    /**
     * @inheritDoc
     */
    public function __construct(bool $production)
    {
        $wsdl = 'https://secure.safebill.ch/EShopRequestV2StdSec.wsdl';
        $options = ['exceptions' => true];

        if (!$production) {
            $wsdl = 'https://sr-pp.swissbilling.ch/EShopRequestV2StdSec.wsdl';
            $options['cache_wsdl'] = WSDL_CACHE_NONE;
            $options['trace'] = true;
        }

        $options['classmap'] = [
            'transactionstatus' => TransactionStatus::class,
            'checkresult' => CheckResult::class,
            'orderitem' => OrderItem::class,
        ];

        parent::__construct($wsdl, $options);
    }
}
