<?php

declare(strict_types=1);

namespace Terminal42\SwissbillingApi;

use Terminal42\SwissbillingApi\Exception\SoapException;
use Terminal42\SwissbillingApi\Soap\ApiV2;
use Terminal42\SwissbillingApi\Soap\ApiV3;
use Terminal42\SwissbillingApi\Type\CheckResult;
use Terminal42\SwissbillingApi\Type\DateTime;
use Terminal42\SwissbillingApi\Type\Debtor;
use Terminal42\SwissbillingApi\Type\InvoiceItem;
use Terminal42\SwissbillingApi\Type\InvoiceStatus;
use Terminal42\SwissbillingApi\Type\Merchant;
use Terminal42\SwissbillingApi\Type\Transaction;
use Terminal42\SwissbillingApi\Type\TransactionStatus;

class Client
{
    /**
     * @var ApiV2|null
     */
    private $apiV2;

    /**
     * @var ApiV3|null
     */
    private $apiV3;

    public function __construct(
        private readonly ApiFactory $apiFactory,
        private readonly Merchant|null $merchant = null,
    ) {
    }

    /**
     * @param array<InvoiceItem> $items
     *
     * @throws SoapException
     */
    public function request(Transaction $transaction, Debtor $debtor, array $items, Merchant|null $merchant = null): TransactionStatus
    {
        if (null === $merchant && null === $this->merchant) {
            throw new \LogicException('Either pass merchant to the constructor or to '.__METHOD__);
        }

        return $this->getApiV2()->EshopTransactionRequest(
            $merchant ?: $this->merchant,
            $transaction,
            $debtor,
            \count($items),
            array_map(static fn (InvoiceItem $item) => (array) $item, $items),
        );
    }

    /**
     * @throws SoapException
     */
    public function confirmation(string $transaction_ref, DateTime $order_timestamp, Merchant|null $merchant = null): TransactionStatus
    {
        if (null === $merchant && null === $this->merchant) {
            throw new \LogicException('Either pass merchant to the constructor or to '.__METHOD__);
        }

        return $this->getApiV2()->EshopTransactionConfirmation(
            $merchant ?: $this->merchant,
            $transaction_ref,
            $order_timestamp,
        );
    }

    /**
     * @throws SoapException
     */
    public function statusRequest(string $transaction_ref, DateTime $order_timestamp, Merchant|null $merchant = null): TransactionStatus
    {
        if (null === $merchant && null === $this->merchant) {
            throw new \LogicException('Either pass merchant to the constructor or to '.__METHOD__);
        }

        return $this->getApiV2()->EshopTransactionStatusRequest(
            $merchant ?: $this->merchant,
            $transaction_ref,
            $order_timestamp,
        );
    }

    /**
     * @param array<InvoiceItem> $items
     *
     * @throws SoapException
     */
    public function direct(Transaction $transaction, Debtor $debtor, array $items, Merchant|null $merchant = null): TransactionStatus
    {
        if (null === $merchant && null === $this->merchant) {
            throw new \LogicException('Either pass merchant to the constructor or to '.__METHOD__);
        }

        return $this->getApiV2()->EshopTransactionDirect(
            $merchant ?: $this->merchant,
            $transaction,
            $debtor,
            \count($items),
            $items,
        );
    }

    /**
     * @throws SoapException
     */
    public function check(DateTime $startdate, DateTime $enddate, string $status, Merchant|null $merchant = null): CheckResult
    {
        if (null === $merchant && null === $this->merchant) {
            throw new \LogicException('Either pass merchant to the constructor or to '.__METHOD__);
        }

        return $this->getApiV2()->EshopTransactionCheck(
            $merchant ?: $this->merchant,
            $startdate,
            $enddate,
            $status,
        );
    }

    /**
     * @throws SoapException
     */
    public function acknowledge(string $transaction_ref, DateTime $order_timestamp, Merchant|null $merchant = null): TransactionStatus
    {
        if (null === $merchant && null === $this->merchant) {
            throw new \LogicException('Either pass merchant to the constructor or to '.__METHOD__);
        }

        return $this->getApiV2()->EshopTransactionAcknowledge(
            $merchant ?: $this->merchant,
            $transaction_ref,
            $order_timestamp,
        );
    }

    /**
     * @throws SoapException
     */
    public function cancel(string $transaction_ref, DateTime $order_timestamp, Merchant|null $merchant = null): TransactionStatus
    {
        if (null === $merchant && null === $this->merchant) {
            throw new \LogicException('Either pass merchant to the constructor or to '.__METHOD__);
        }

        return $this->getApiV3()->EshopTransactionCancel([
            'merchant' => $merchant ?: $this->merchant,
            'transaction_ref' => $transaction_ref,
            'timestamp' => $order_timestamp,
        ])->EshopTransactionCancelResult;
    }

    /**
     * @throws SoapException
     */
    public function unCancel(string $transaction_ref, DateTime $order_timestamp, Merchant|null $merchant = null): TransactionStatus
    {
        if (null === $merchant && null === $this->merchant) {
            throw new \LogicException('Either pass merchant to the constructor or to '.__METHOD__);
        }

        return $this->getApiV3()->EshopTransactionUnCancel([
            'merchant' => $merchant ?: $this->merchant,
            'transaction_ref' => $transaction_ref,
            'timestamp' => $order_timestamp,
        ])->EshopTransactionUnCancelResult;
    }

    /**
     * @param array<InvoiceItem> $items
     *
     * @throws SoapException
     */
    public function preScreening(Transaction $transaction, Debtor $debtor, array $items, Merchant|null $merchant = null): TransactionStatus
    {
        if (null === $merchant && null === $this->merchant) {
            throw new \LogicException('Either pass merchant to the constructor or to '.__METHOD__);
        }

        return $this->getApiV3()->EshopTransactionPreScreening([
            'merchant' => $merchant ?: $this->merchant,
            'transaction' => $transaction,
            'debtor' => $debtor,
            'item_count' => \count($items),
            'items' => $items,
        ])->EshopTransactionPreScreeningResult;
    }

    /**
     * @throws SoapException
     */
    public function creditNote(string $transaction_ref, DateTime $order_timestamp, float $amount, string $transaction_ref_new, string $notes, Merchant|null $merchant = null): TransactionStatus
    {
        if (null === $merchant && null === $this->merchant) {
            throw new \LogicException('Either pass merchant to the constructor or to '.__METHOD__);
        }

        return $this->getApiV3()->EShopTransactionCreditNote([
            'merchant' => $merchant ?: $this->merchant,
            'transaction_ref' => $transaction_ref,
            'timestamp' => $order_timestamp,
            'amount' => $amount,
            'transaction_ref_new' => $transaction_ref_new,
            'notes' => $notes,
        ])->EShopTransactionCreditNoteResult;
    }

    /**
     * @param array<InvoiceItem> $items
     *
     * @throws SoapException
     */
    public function update(Transaction $transaction, array $items, Merchant|null $merchant = null): TransactionStatus
    {
        if (null === $merchant && null === $this->merchant) {
            throw new \LogicException('Either pass merchant to the constructor or to '.__METHOD__);
        }

        return $this->getApiV3()->EShopTransactionUpdate([
            'merchant' => $merchant ?: $this->merchant,
            'transaction' => $transaction,
            'debtor' => null,
            'item_count' => \count($items),
            'items' => $items,
        ])->EShopTransactionUpdateResult;
    }

    /**
     * @throws SoapException
     */
    public function getInvoice(string $transaction_ref, DateTime $order_timestamp, string $ReportType, Merchant|null $merchant = null): InvoiceStatus
    {
        if (null === $merchant && null === $this->merchant) {
            throw new \LogicException('Either pass merchant to the constructor or to '.__METHOD__);
        }

        return $this->getApiV3()->EShopTransactionGetInvoice([
            'merchant' => $merchant ?: $this->merchant,
            'transaction_ref' => $transaction_ref,
            'order_timestamp' => $order_timestamp,
            'ReportType' => $ReportType,
        ])->EShopTransactionGetInvoiceResult;
    }

    /**
     * Returns the merchant that was passed to the constructor (if any).
     */
    public function getMerchant(): Merchant|null
    {
        return $this->merchant;
    }

    /**
     * @throws SoapException
     */
    private function getApiV2(): ApiV2
    {
        if (null === $this->apiV2) {
            $this->apiV2 = $this->apiFactory->createV2();
        }

        return $this->apiV2;
    }

    /**
     * @throws SoapException
     */
    private function getApiV3(): ApiV3
    {
        if (null === $this->apiV3) {
            $this->apiV3 = $this->apiFactory->createV3();
        }

        return $this->apiV3;
    }
}
