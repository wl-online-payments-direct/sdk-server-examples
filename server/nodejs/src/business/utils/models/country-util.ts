import { Country } from '../../domain/common/enums/country';

const COUNTRY_ISO_CODES: Record<Country, string> = {
    [Country.England]: 'GB',
    [Country.Germany]: 'DE',
    [Country.France]: 'FR',
};

export const CountryUtil = {
    toIsoAlpha2(country?: Country | null): string {
        if (!country) {
            return '';
        }

        return COUNTRY_ISO_CODES[country] ?? '';
    },
};
