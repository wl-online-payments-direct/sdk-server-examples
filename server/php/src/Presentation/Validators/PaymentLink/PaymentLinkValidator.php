<?php

namespace OnlinePayments\ExampleApp\Presentation\Validators\PaymentLink;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Currency;
use OnlinePayments\ExampleApp\Application\Domain\Enums\PaymentLinks\Action;
use OnlinePayments\ExampleApp\Application\Domain\Enums\PaymentLinks\ValidFor;
use OnlinePayments\ExampleApp\Configuration\Exceptions\ValidationException;
use OnlinePayments\ExampleApp\Presentation\Models\PaymentLink\Request;

class PaymentLinkValidator
{
    /**
     * @throws ValidationException
     */
    public function validate(Request $request): array
    {
        $errors = [];

        error_log("Amount: " . $request->amount);

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

        if (!empty($request->description) && !is_string($request->description)) {
            $errors[] = 'The Description field must be a string.';
        }
        elseif (is_string($request->description) && mb_strlen($request->description) > 1000) {
            $errors[] = "The Description field must be shorter than 1000 characters.";
        }

        $validFor = property_exists($request, 'validFor') ? $request->validFor : null;

        if ($validFor === null) {
            $errors[] = 'The ValidFor field is required.';
        }
        elseif (!ctype_digit($validFor)) {
            $errors[] = 'The ValidFor field is invalid.';
        }
        elseif (ValidFor::tryFrom((int)$validFor) === null) {
            $errors[] = 'The ValidFor field is in invalid range and must be a number from the following set: 24, 48, 336, 720.';
        }
        else {
            $validForInt = (int) $request->validFor;

            if (!ValidFor::tryFrom($validForInt)) {
                $errors[] = 'Unsupported validity period.';
            }
        }

        if (!property_exists($request, 'action') || $request->action === null) {
            $errors[] = 'The Action field is required.';
        }
        elseif (!is_string($request->action) || !Action::tryFrom($request->action)) {
            $errors[] = 'The Action field is invalid.';
        }

        if (!empty($errors)) {
            throw new ValidationException($errors);
        }

        return $errors;
    }
}
