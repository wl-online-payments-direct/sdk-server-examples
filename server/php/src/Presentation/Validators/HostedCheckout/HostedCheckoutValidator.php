<?php

namespace OnlinePayments\ExampleApp\Presentation\Validators\HostedCheckout;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Currency;
use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Language;
use OnlinePayments\ExampleApp\Configuration\Exceptions\ValidationException;
use OnlinePayments\ExampleApp\Presentation\Models\HostedCheckout\Request;
use OnlinePayments\ExampleApp\Presentation\Validators\Rules\AddressRules;

class HostedCheckoutValidator
{
    /**
     * @throws ValidationException
     */
    public function validate(Request $request): array
    {
        $errors = [];

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

        if (!$request->language) {
            $errors[] = 'The Language field is required.';
        }
        elseif (Language::tryFrom($request->language) === null) {
            $errors[] = 'The Language field is invalid.';
        }

        if (!empty($request->redirectUrl)) {
            if (!filter_var($request->redirectUrl, FILTER_VALIDATE_URL)) {
                $errors[] = 'The RedirectUrl field is invalid.';
            }
        }

        if (!empty($request->billingAddress)) {
            $errors = array_merge($errors, AddressRules::validateAddress($request->billingAddress, 'BillingAddress'));
        }

        if (!empty($request->shippingAddress)) {
            $errors = array_merge($errors, AddressRules::validateAddress($request->shippingAddress, 'ShippingAddress'));
        }

        if (!empty($errors)) {
            throw new ValidationException($errors);
        }

        return $errors;
    }

}
