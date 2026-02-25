<?php

namespace OnlinePayments\ExampleApp\Presentation\Validators\Rules;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Country;

class CountryRules
{
    private const SUPPORTED_COUNTRIES = [
        Country::England,
        Country::France,
        Country::Germany
    ];
    public static function validateCountry(?string $country, string $prefix): array
    {
        $errors = [];

        if ($country === null || trim($country) === '') {
            $errors[] = "The {$prefix}.Country field is required.";
        }
        else {
            $countryEnum = Country::tryFrom($country);

            if ($countryEnum === null) {
                $errors[] = "The {$prefix}.Country field is invalid.";
            }
            elseif (!in_array($countryEnum, self::SUPPORTED_COUNTRIES, true)) {
                $errors[] = "Unsupported {$prefix}.country.";
            }
        }

        return $errors;
    }
}