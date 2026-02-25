<?php
namespace OnlinePayments\ExampleApp\Presentation\Validators\Rules;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Country;
use OnlinePayments\ExampleApp\Application\Extensions\Models\CountryExtension;

class IbanRules
{
    private const BASIC_IBAN_REGEX = '/^[A-Z]{2}\d{2}[A-Z0-9]+$/';

    private const IBAN_LENGTHS = [
        'FR' => 27,
        'DE' => 22,
        'GB' => 22,
    ];

    public static function clean(?string $iban): string
    {
        if ($iban === null) {
            return '';
        }

        return strtoupper(preg_replace('/[^a-zA-Z0-9]/', '', $iban));
    }

    private static function getCountrySpec(Country $country): ?array
    {
        $isoCode = CountryExtension::toIsoAlpha2($country);

        if (empty($isoCode) || !isset(self::IBAN_LENGTHS[$isoCode])) {
            return null;
        }

        return [
            'prefix' => $isoCode,
            'length' => self::IBAN_LENGTHS[$isoCode]
        ];
    }

    private static function hasValidChecksum(string $iban): bool
    {
        $rear = substr($iban, 4) . substr($iban, 0, 4);

        $remainder = 0;
        $length = strlen($rear);

        for ($i = 0; $i < $length; $i++) {
            $ch = $rear[$i];

            if (ctype_alpha($ch)) {
                $digits = (string)((ord($ch) - ord('A')) + 10);
            }
            else {
                $digits = $ch;
            }

            foreach (str_split($digits) as $d) {
                $remainder = ($remainder * 10 + ((int)$d - 0)) % 97;
            }
        }

        return $remainder === 1;
    }

    public static function validateIban(?string $iban, ?Country $country = null): array
    {
        $errors = [];

        if (empty($iban)) {
            return $errors;
        }

        $cleanedIban = self::clean($iban);

        if (!preg_match(self::BASIC_IBAN_REGEX, $cleanedIban)) {
            $errors[] = 'IBAN format is invalid (expected: 2 letters country + 2 digits + alphanumerics).';
            return $errors;
        }

        if ($country !== null) {
            $spec = self::getCountrySpec($country);

            if ($spec === null) {
                $errors[] = 'IBAN country is not supported.';
            }
            else {
                $prefix = $spec['prefix'];
                $expectedLength = $spec['length'];

                if (!str_starts_with($cleanedIban, $prefix) || strlen($cleanedIban) !== $expectedLength) {
                    $countryName = $country->value;
                    $errors[] = "IBAN must start with '{$prefix}' and be {$expectedLength} characters for {$countryName}.";
                }
            }
        }

        if (!self::hasValidChecksum($cleanedIban)) {
            $errors[] = 'IBAN checksum is invalid.';
        }

        return $errors;
    }
}