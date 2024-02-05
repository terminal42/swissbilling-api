<?php

declare(strict_types=1);

namespace Terminal42\SwissbillingApi\Type;

/**
 * @property string $short_desc Name of product (short description)
 * @property string $desc       Additional information about the product
 * @property int    $quantity   Quantity ordered of the product
 * @property float  $unit_price Price per unit inclusive VAT
 * @property float  $VAT_rate   VAT rate
 * @property float  $VAT_amount VAT amount for one unit
 * @property string $file_link  URL of a file accessible via internet
 * @property string $image_type Type of picture GIF, JPG or PNG
 * @property string $image      Picture in binary format (base64)
 */
class InvoiceItem extends AbstractType
{
}
