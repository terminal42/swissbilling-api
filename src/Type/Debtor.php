<?php

declare(strict_types=1);

namespace Terminal42\SwissbillingApi\Type;

/**
 * @property string   $company_name       Company name
 * @property string   $title              Title
 * @property string   $firstname          First name
 * @property string   $lastname           Last name
 * @property DateTime $birthdate          Birthdate
 * @property string   $adr1               Address
 * @property string   $adr2               Additional info about address
 * @property string   $street_nr          Street number
 * @property string   $city               City
 * @property string   $zip                PLZ
 * @property string   $country            Country: CH in capitals (only CH is authorised)
 * @property string   $email              Email address of the customer
 * @property string   $phone              Phone. Format (+([0-9])*)
 * @property string   $language           Language of the customer. FR or DE in capitals
 * @property int      $user_ID            Unique ID given by the shop
 * @property string   $deliv_company_name Deliver : Company name
 * @property string   $deliv_title        Deliver : title of customer
 * @property string   $deliv_firstname    Deliver : first name of customer
 * @property string   $deliv_lastname     Deliver: last name of customer
 * @property string   $deliv_adr1         Deliver: address of customer
 * @property string   $deliv_adr2         Deliver: additional info about address
 * @property string   $deliv_street_nr    Deliver: street number of customer
 * @property string   $deliv_city         Deliver: City of customer
 * @property string   $deliv_zip          Deliver: PLZ of customer
 * @property string   $deliv_country      Deliver : Country of customer example: CH in capital letter (only CH is authorised)
 */
class Debtor extends AbstractType
{
    public function __construct(array $input = [])
    {
        parent::__construct(array_merge(
            [
                'SBMember_ID' => 0,
            ],
            $input,
        ));
    }
}
