<?php

namespace OnlinePayments\ExampleApp\Application\Extensions\Models;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Country;
use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Language;

class LanguageExtensions
{
    private const LANGUAGE_ISO_CODES = [
        Language::English->value => 'en',
        Language::German->value => 'de',
        Language::French->value => 'fr',
    ];

    public static function toLocale(?Language $language, ?Country $country): string
    {
        if ($language === null || $country === null) {
            return '';
        }

        $languageCode = self::LANGUAGE_ISO_CODES[$language->value] ?? '';
        if ($languageCode === '') {
            return '';
        }

        $countryCode = CountryExtension::toIsoAlpha2($country);
        if ($countryCode === '') {
            return '';
        }

        return "{$languageCode}-{$countryCode}";
    }
}
