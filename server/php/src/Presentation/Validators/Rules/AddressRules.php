<?php
namespace OnlinePayments\ExampleApp\Presentation\Validators\Rules;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Country;
use ValueError;

class AddressRules
{
    public static function validateAddress(?object $address, string $prefix): array
    {
        $errors = [];

        if ($address === null) {
            return $errors;
        }

        $firstName = $address->firstName ?? null;
        $lastName = $address->lastName ?? null;

        if ($firstName === null || $firstName === '') {
            $errors[] = "The $prefix.FirstName field is required.";
        }

        if ($lastName === null || $lastName === '') {
            $errors[] = "The $prefix.LastName field is required.";
        }

        $city = $address->city ?? null;
        $street = $address->street ?? null;

        if ($city === null || $city === '') {
            $errors[] = "The $prefix.City field is required.";
        }

        if ($street === null || $street === '') {
            $errors[] = "The $prefix.Street field is required.";
        }

        if (!isset($address->country)) {
            $errors[] = "The $prefix.Country field is required.";
        }

        $errors = array_merge($errors, CountryRules::validateCountry($address->country, $prefix));

        $zipRaw = $address->zip ?? null;

        if ($zipRaw === null || trim($zipRaw) === '' || $address->country === null) {
            $errors[] = "The $prefix.Zip field is required.";
        }
        else {
            $countryEnum = null;
            if (!$address->country instanceof Country) {
                try {
                    $countryEnum = Country::from($address->country);
                } catch (ValueError $e) {
                }
            }

            if ($countryEnum instanceof Country) {
                $zipErrors = ZipRules::validateZipForCountry($zipRaw, $countryEnum);
                $errors = array_merge($errors, $zipErrors);
            }
        }

        return $errors;
    }
}