<?php

declare(strict_types=1);

namespace Terminal42\SwissbillingApi\Type;

/**
 * @property int    $transaction_id         Reference number furnished by the merchants shop
 * @property string $status                 Status of the transaction
 * @property string $action
 * @property string $url                    URL for redirection to SWISSBILLING for certain methods
 * @property string $merchantmsg            (Legacy) Depreciated field substituted by failure_text_merchant
 * @property string $debtormsg              (Legacy) Depreciated field substituted by failure_text_debtor
 * @property float  $invoicing_costs        Added costs, for exemple, for the shippment of the invoice by post or email.
 * @property bool   $partial_payment        This field is used for payment in stalments (in option).
 * @property float  $partial_payment_fees   This field is used for payment in stalments (in option).
 * @property float  $partial_payment_rate   This field is used for payment in stalments (in option).
 * @property object $partial_payment_table  This field is used for payment in stalments (in option).
 * @property int    $sb_member_id           (Legacy) always 0 – fiel dis not used
 * @property int    $failure_code           Error code as : 110,111, etc.
 * @property string $failure_text_debtor    Text of refusal sent to the customer, can be displayed as it is on the site , the text is in the language provided when ordering
 * @property string $failure_text_merchant  Text of refusal sent to the merchant, with detailed explanation
 * @property string $internal_debug_message Always emplty, only for internal use
 * @property float  $amount                 Remaining amount of the credit limit
 * @property string $partnerID              PSP partner reference (for exemple DATATRANS) *1
 * @property int    $swb_transaction_id     Unique reference number furnished by SWISSBILLING, and the invoice later
 */
class TransactionStatus extends AbstractType
{
    public const STATUS_IN_PROCESS = 'In process';

    public const STATUS_CANCELED_BY_USER = 'Canceled by user';

    public const STATUS_FAILED = 'Failed';

    public const STATUS_ANSWERED = 'Answered';

    public const STATUS_TIMED_OUT = 'Timed Out';

    public const STATUS_PROCESSED = 'Processed';

    public const STATUS_MEMBERSHIP_VALIDATION = 'Membership validation';

    public const STATUS_TEST_APPROVED = 'Test approved';

    public const STATUS_ACKNOWLEDGED = 'Acknowledged';

    public const STATUS_CANCELED_BY_MERCHANT = 'Canceled by merchant';

    public const STATUS_DELAYED_FOR_VALIDATION = 'Delayed for validation';

    public const STATUS_PAYMENT_VALIDATION = 'Payment validation';

    public const STATUS_TRANSACTION_CHECK_FAILURE = 'Transaction check failure';

    public const STATUS_ADDRESS_VALIDATION = 'Address validation';

    public const STATUS_PENDING_SHOP_CONFIRMATION = 'Pending shop confirmation';

    public const ACTION_ERROR = 'Error';

    public function hasError(): bool
    {
        return $this->failure_code > 0;
    }

    public function isAnswered(): bool
    {
        return self::STATUS_ANSWERED === $this->status;
    }

    public function isAcknowledged(): bool
    {
        return self::STATUS_ACKNOWLEDGED === $this->status;
    }
}
