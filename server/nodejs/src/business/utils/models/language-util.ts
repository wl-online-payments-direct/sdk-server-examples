import { Language } from '../../domain/common/enums/language';
import { Country } from '../../domain/common/enums/country';
import { CountryUtil } from './country-util';

const LANGUAGE_ISO_CODES: Record<Language, string> = {
    [Language.English]: 'en',
    [Language.German]: 'de',
    [Language.French]: 'fr',
};

export const LanguageUtil = {
    toLocale(language?: Language | null, country?: Country | null): string {
        if (!language || !country) {
            return '';
        }

        const languageCode = LANGUAGE_ISO_CODES[language];

        if (!languageCode) {
            return '';
        }

        const countryCode = CountryUtil.toIsoAlpha2(country);

        return countryCode ? `${languageCode}-${countryCode}` : '';
    },
};
