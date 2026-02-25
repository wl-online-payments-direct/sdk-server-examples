<?php

namespace OnlinePayments\ExampleApp\Application\Extensions\Models;

use OnlinePayments\ExampleApp\Application\Domain\Enums\Common\Country;

class CountryExtension
{
    private const COUNTRY_ISO_CODES = [
        Country::England->value => 'GB',
        Country::Germany->value => 'DE',
        Country::France->value  => 'FR',
    ];

    public static function toIsoAlpha2(?Country $country): string
    {
        if ($country === null) {
            return '';
        }

        return self::COUNTRY_ISO_CODES[$country->value] ?? '';
    }
}
