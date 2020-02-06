<?php

namespace Terminal42\SwissbillingApi\Type;

/**
 * @property string    $type                    (Legacy) Always give the value « Real » in mode STAGING as in PRODUCTION
 * @property boolean   $is_B2B                  If the transaction is a B2B transaction (your account should be set to accept B2B transaction, please contact us)
 * @property string    $eshop_ID                One merchant can have several shops connected to one and only interface. This ID is given to identify which shop is passing the transaction.
 * @property string    $eshop_ref               Number of the current order delivered by the shop
 * @property \DateTime $order_timestamp         Date and time of the current order format : yyyy-mm-ddThh-mm-ss
 * @property string    $currency                Code ISO of the currency : only the code CHF is authorised
 * @property float     $amount                  Total amount of the actual order with extra costs and taxes included.
 * @property float     $VAT_amount              Amount of VAT (can be 0)
 * @property float     $admin_fee_amount        Administrative costs of (and for) the merchant
 * @property float     $delivery_fee_amount     Deliver costs of (and for) the merchant
 * @property float     $coupon_discount_amount  Discount, coupon
 * @property float     $vol_discount            Volume discount
 * @property boolean   $phys_delivery           A product has to be physically delivered. Virtual products (as movies or so) are forbidden. Only value « true » (1) will be accepted.
 * @property string    $debtor_IP               IP address of the customer
 * @property string    $delivery_status         (Legacy) always give the value “pending”.
 * @property string    $signature               (Legacy) always leave this field empty
 * @property string    $partnerID               ID furnished by PSP partner (third party), for a merchant which connects directly to SWB this field has to be empty.
 * @property boolean   $is_DirectInvoiceByEmail EshopTransactionDirect() only : “true” (1) for an invoice received by email or “false” (0) for a paper invoice received by post
 * @property string    $DirectSuccessStatus
 * @property string    $subscription_id
 * @property string    $instructions
 * @property integer   $prescreening_id
 * @property integer   $installment_count
 */
class Transaction extends AbstractType
{
    public function __construct(array $input = [])
    {
        parent::__construct(array_merge(
            [
                'type' => 'Real',
                'is_B2B' => false,
                'currency' => 'CHF',
                'delivery_status' => 'pending',
                'signature' => '',
            ],
            $input
        ));
    }
}
