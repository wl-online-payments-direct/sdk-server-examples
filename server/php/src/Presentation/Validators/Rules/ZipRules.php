<?php
namespace OnlinePayments\ExampleApp\Presentation\Validators\Rules;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Country;

class ZipRules
{
    private const UK_POSTCODE_REGEX = '/^([Gg][Ii][Rr]\s?0[Aa]{2}|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-HJ-Ya-hj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-HJ-Ya-hj-y][0-9][A-Za-z]?))))\s?[0-9][A-Za-z]{2}))$/';

    private const FRANCE_ZIP_REGEX = '/^(?:0[1-9]|[1-8]\d|9[0-5]|97[1-8]|98\d)\d{3}$/';

    private const GERMANY_ZIP_REGEX = '/^(0[1-9]\d{3}|[1-9]\d{4})$/';

    public static function validateZipForCountry(?string $zip, Country $country): array
    {
        $errors = [];

        if ($zip === null || trim($zip) === '') {
            return $errors;
        }

        $trimmedZip = trim($zip);

        if (!self::isZipValidForCountry($trimmedZip, $country)) {
            $errors[] = self::getErrorMessageForCountry($country);
        }

        return $errors;
    }

    private static function isZipValidForCountry(string $zip, Country $country): bool
    {
        return match($country) {
            Country::France => preg_match(self::FRANCE_ZIP_REGEX, $zip) === 1,
            Country::Germany => preg_match(self::GERMANY_ZIP_REGEX, $zip) === 1,
            Country::England => preg_match(self::UK_POSTCODE_REGEX, $zip) === 1,
            default => false
        };
    }

    private static function getErrorMessageForCountry(Country $country): string
    {
        return match($country) {
            Country::France => 'Zip code must be 5 digits for France.',
            Country::Germany => 'Zip code must be 5 digits for Germany.',
            Country::England => 'UK postcode must be in a valid format (e.g., SW1A 2AA, W1A 0AX, M1 1AE).',
            default => 'Zip/postal code is invalid for the selected country.'
        };
    }
}