<?php

namespace OnlinePayments\ExampleApp\Presentation\Validators\Payment;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Currency;
use OnlinePayments\ExampleApp\Application\Domain\Enums\Payments\PaymentMethodType;
use OnlinePayments\ExampleApp\Configuration\Exceptions\ValidationException;
use OnlinePayments\ExampleApp\Presentation\Models\Payment\Request;
use OnlinePayments\ExampleApp\Presentation\Validators\Rules\CardRules;
use OnlinePayments\ExampleApp\Presentation\Validators\Rules\CountryRules;
use OnlinePayments\ExampleApp\Presentation\Validators\Rules\MandateRules;

final class PaymentValidator
{
    /**
     * @throws ValidationException
     */
    public function validate(Request $request): array
    {
        $errors = [];

        if (!empty($request->hostedTokenizationId)) {
            if ($request->card !== null) {
                $cardEmpty = (
                    empty($request->card->number)
                    && empty($request->card->holderName)
                    && empty($request->card->verificationCode)
                    && empty($request->card->expiryMonth)
                    && empty($request->card->expiryYear)
                );

                if (!$cardEmpty) {
                    $errors[] = 'If hosted tokenization id is provided, card details must not be filled.';
                }
            }
        }

        if (!isset($request->amount)) {
            $errors[] = 'The Amount field is required.';
        }
        elseif (!is_numeric($request->amount)) {
            $errors[] = 'The Amount field must be a number.';
        }
        elseif ((int)$request->amount <= 0) {
            $errors[] = 'The Amount field must be greater than zero.';
        }

        if (!$request->currency) {
            $errors[] = 'The Currency field is required.';
        }
        elseif (Currency::tryFrom($request->currency) === null) {
            $errors[] = 'The Currency field is invalid.';
        }

        $methodEnum = isset($request->method) ? PaymentMethodType::tryFrom($request->method) : null;
        if (!$request->method) {
            $errors[] = 'The Method field is required.';
        }
        elseif ($methodEnum === null) {
            $errors[] = 'The Method field is invalid.';
        }

        if ($methodEnum === PaymentMethodType::CREDIT_CARD) {
            $errors = array_merge($errors, CardRules::validateCard($request->card));

            if(isset($request->billingAddress->country)){
                $errors = array_merge($errors, CountryRules::validateCountry($request->billingAddress->country, 'BillingAddress'));
            }

            if(isset($request->billingAddress->country)){
                $errors = array_merge($errors, CountryRules::validateCountry($request->billingAddress->country, 'BillingAddress'));
            }
        }

        if ($methodEnum === PaymentMethodType::DIRECT_DEBIT) {
            $errors = array_merge($errors, MandateRules::validateMandate($request->mandate));
        }

        if (!empty($errors)) {
            throw new ValidationException($errors);
        }

        return $errors;
    }
}
