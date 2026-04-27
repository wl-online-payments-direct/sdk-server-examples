import { Country } from '../../../business/domain/common/enums/country';

export class ZipRules {
    private static readonly UK_POSTCODE_REGEX =
        /^([Gg][Ii][Rr]\s?0[Aa]{2}|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-HJ-Ya-hj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-HJ-Ya-hj-y][0-9][A-Za-z]?))))\s?[0-9][A-Za-z]{2}))$/;

    private static readonly FRANCE_ZIP_REGEX =
        /^(?:0[1-9]|[1-8]\d|9[0-5]|97[1-8]|98\d)\d{3}$/;

    private static readonly GERMANY_ZIP_REGEX =
        /^(0[1-9]\d{3}|[1-9]\d{4})$/;

    static validateZipForCountry(zip?: string | null, country?: Country | null): string[] {
        const errors: string[] = [];

        if (zip === null || zip === undefined || zip.trim() === '') {
            return errors;
        }

        const trimmedZip = zip.trim();

        if (!this.isZipValidForCountry(trimmedZip, country)) {
            errors.push(this.getErrorMessageForCountry(country));
        }

        return errors;
    }

    private static isZipValidForCountry(zip: string, country?: Country | null): boolean {
        switch (country) {
            case Country.France:
                return this.FRANCE_ZIP_REGEX.test(zip);
            case Country.Germany:
                return this.GERMANY_ZIP_REGEX.test(zip);
            case Country.England:
                return this.UK_POSTCODE_REGEX.test(zip);
            default:
                return false;
        }
    }

    private static getErrorMessageForCountry(country?: Country | null): string {
        switch (country) {
            case Country.France:
                return 'Zip code must be 5 digits for France.';
            case Country.Germany:
                return 'Zip code must be 5 digits for Germany.';
            case Country.England:
                return 'UK postcode must be in a valid format (e.g., SW1A 2AA, W1A 0AX, M1 1AE).';
            default:
                return 'Zip/postal code is invalid for the selected country.';
        }
    }
}