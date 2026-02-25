<?php

namespace OnlinePayments\ExampleApp\Presentation\Validators\AdditionalPaymentAction;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Currency;
use OnlinePayments\ExampleApp\Configuration\Exceptions\ValidationException;
use OnlinePayments\ExampleApp\Presentation\Models\AdditionalPaymentActions\Request;

final class AdditionalPaymentActionValidator
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

        if (!empty($errors)) {
            throw new ValidationException($errors);
        }

        return $errors;
    }
}
