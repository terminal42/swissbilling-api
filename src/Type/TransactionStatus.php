<?php

namespace Terminal42\SwissbillingApi\Type;

/**
 * @property integer $transaction_id         Reference number furnished by the merchants shop
 * @property string  $status                 Status of the transaction
 * @property string  $action
 * @property string  $url                    URL for redirection to SWISSBILLING for certain methods
 * @property string  $merchantmsg            (Legacy) Depreciated field substituted by failure_text_merchant
 * @property string  $debtormsg              (Legacy) Depreciated field substituted by failure_text_debtor
 * @property float   $invoicing_costs        Added costs, for exemple, for the shippment of the invoice by post or email.
 * @property boolean $partial_payment        This field is used for payment in stalments (in option).
 * @property float   $partial_payment_fees   This field is used for payment in stalments (in option).
 * @property float   $partial_payment_rate   This field is used for payment in stalments (in option).
 * @property object  $partial_payment_table  This field is used for payment in stalments (in option).
 * @property integer $sb_member_id           (Legacy) always 0 – fiel dis not used
 * @property integer $failure_code           Error code as : 110,111, etc.
 * @property string  $failure_text_debtor    Text of refusal sent to the customer, can be displayed as it is on the site , the text is in the language provided when ordering
 * @property string  $failure_text_merchant  Text of refusal sent to the merchant, with detailed explanation
 * @property string  $internal_debug_message Always emplty, only for internal use
 * @property float   $amount                 Remaining amount of the credit limit
 * @property string  $partnerID              PSP partner reference (for exemple DATATRANS) *1
 * @property integer $swb_transaction_id     Unique reference number furnished by SWISSBILLING, and the invoice later
 */
class TransactionStatus extends AbstractType
{
    public const STATUS_ANSWERED = 'Answered';
    public const STATUS_MEMBERSHIP_VALIDATION = 'Membership validation';
    public const STATUS_PENDING_SHOP_CONFIRMATION = 'Pending shop confirmation';

    public const ACTION_ERROR = 'Error';

    public function hasError()
    {
        return $this->failure_code > 0;
    }

    public function isAnswered()
    {
        return $this->status === self::STATUS_ANSWERED;
    }
}
