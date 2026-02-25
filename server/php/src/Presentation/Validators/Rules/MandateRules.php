<?php

namespace OnlinePayments\ExampleApp\Presentation\Validators\Rules;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Country;
use OnlinePayments\ExampleApp\Application\Domain\Enums\Payments\RecurrenceType;
use OnlinePayments\ExampleApp\Application\Domain\Enums\Payments\SignatureType;

class MandateRules
{
    public static function validateMandate(?object $mandate): array
    {
        $errors = [];

        if ($mandate === null) {
            $errors[] = 'Mandate is required for DIRECT_DEBIT payments.';
            return $errors;
        }

        if (empty($mandate->customerReference)) {
            $errors[] = 'The CustomerReference field is required.';
        }
        elseif (mb_strlen($mandate->customerReference) > 35) {
            $errors[] = 'The CustomerReference field must be shorter than 36 characters.';
        }

        $mandateReference = $mandate->mandateReference ?? null;
        $iban = $mandate->iban ?? null;

        if (empty($mandateReference) && empty($iban)) {
            $errors[] = 'IBAN is required when mandate reference is not provided.';
        }
        elseif (!empty($iban)) {

            if (strlen($iban) > 50) {
                $errors[] = 'IBAN field must be less than 51 characters.';
            }
            else {
                $country = null;
                if (!empty($mandate->address) && !empty($mandate->address->country)) {
                    $country = Country::tryFrom($mandate->address->country);
                }

                $ibanErrors = IbanRules::validateIban($iban, $country);
                $errors = array_merge($errors, $ibanErrors);
            }
        }

        if (!$mandate->recurrenceType) {
            $errors[] = 'The RecurrenceType field is required.';
        }
        elseif (RecurrenceType::tryFrom($mandate->recurrenceType) === null) {
            $errors[] = 'The RecurrenceType field is invalid.';
        }

        if (!$mandate->signatureType) {
            $errors[] = 'The SignatureType field is required.';
        }
        elseif (SignatureType::tryFrom($mandate->signatureType) === null) {
            $errors[] = 'The SignatureType field is invalid.';
        }


        if (!empty($mandate->returnUrl) && !filter_var($mandate->returnUrl, FILTER_VALIDATE_URL)) {
            $errors[] = 'The ReturnUrl field is invalid.';
        }

        if (empty($mandateReference)) {
            if ($mandate->address === null) {
                $errors[] = 'Address is required when mandate reference is not provided.';
            }
            else {
                $errors = array_merge($errors, AddressRules::validateAddress($mandate->address, 'Mandate.Address'));
            }
        }

        return $errors;
    }
}
