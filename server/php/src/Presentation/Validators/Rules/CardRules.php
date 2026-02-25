<?php

namespace OnlinePayments\ExampleApp\Presentation\Validators\Rules;

use OnlinePayments\ExampleApp\Configuration\Exceptions\ValidationException;

class CardRules
{
    public static function validateCard(?object $card): array
    {
        $errors = [];

        if ($card === null) {
            $errors[] = 'The Card object is required.';
            return $errors;
        }

        if (empty($card->number)) {
            $errors[] = 'The Card.Number field is required.';
        }
        else {
            if (!is_numeric((string)$card->number)) {
                $errors[] = 'The Card.Number field must be a valid number.';
            }

            if (strlen((string)$card->number) > 19) {
                $errors[] = 'The Card.Number field must be shorter than 20 characters.';
            }
        }

        if (empty($card->holderName)) {
            $errors[] = 'The Card.HolderName field is required.';
        }

        if (empty($card->verificationCode)) {
            $errors[] = 'The Card.VerificationCode is required.';
        }
        else {
            $len = strlen((string)$card->verificationCode);
            if ($len < 3 || $len > 4 || !is_numeric((string)$card->verificationCode)) {
                $errors[] = 'The Card.VerificationCode must be 3 or 4 digits long.';
            }
        }

        $monthValid = false;
        if (empty($card->expiryMonth)) {
            $errors[] = 'The Card.ExpiryMonth is required.';
        }
        else {
            $monthStr = (string)$card->expiryMonth;
            if (!is_numeric($monthStr)) {
                $errors[] = 'The Card.ExpiryMonth field must be a number.';
            }
            elseif (strlen($monthStr) !== 2) {
                $errors[] = 'The Card.ExpiryMonth field must be 2 digits long.';
            }
            else {
                $m = (int)$monthStr;
                if ($m < 1 || $m > 12) {
                    $errors[] = 'The Card.ExpiryMonth must be a number between 01 and 12.';
                }
                else {
                    $monthValid = true;
                }
            }
        }

        $yearValid = false;
        if (empty($card->expiryYear)) {
            $errors[] = 'The Card.ExpiryYear is required.';
        }
        else {
            $yearStr = (string)$card->expiryYear;
            if (!is_numeric($yearStr)) {
                $errors[] = 'The Card.ExpiryYear field must be a number.';
            }
            elseif (strlen($yearStr) !== 4) {
                $errors[] = 'The Card.ExpiryYear field must be 4 digits long.';
            }
            else {
                $yearValid = true;
            }
        }

        if ($monthValid && $yearValid) {
            try {
                if (!self::hasFutureExpiryDate($card->expiryMonth, $card->expiryYear)) {
                    $errors[] = 'The card expiry date must be in the future.';
                }
            } catch (ValidationException $e) {
                $errors[] = $e->getMessage();
            }
        }

        return $errors;
    }

    /**
     * @throws ValidationException
     */
    private static function hasFutureExpiryDate(string $month, string $year): bool
    {
        $m = (int)$month;
        $y = (int)$year;

        if ($m < 1 || $m > 12 || $y < 0) {
            throw new ValidationException(['Invalid expiry month or year.']);
        }
        try {
            $expiry = new \DateTimeImmutable(sprintf('%04d-%02d-01 23:59:59', $y, $m), new \DateTimeZone('UTC'));
            $expiry = $expiry->modify('last day of this month')->setTime(23, 59, 59);
            $now = new \DateTimeImmutable('now', new \DateTimeZone('UTC'));

            return $expiry > $now;
        } catch (\Throwable $e) {
            throw new ValidationException(['Invalid expiry date.']);
        }
    }
}
