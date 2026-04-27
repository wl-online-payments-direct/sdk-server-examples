import { Country } from '../../../business/domain/common/enums/country';

export class IbanRules {
    private static readonly BASIC_IBAN_REGEX = /^[A-Z]{2}\d{2}[A-Z0-9]+$/;

    private static readonly IBAN_LENGTHS: Record<string, number> = {
        FR: 27,
        DE: 22,
        GB: 22,
    };

    static clean(iban: string | null | undefined): string {
        if (iban === null || iban === undefined) {
            return '';
        }

        return iban.replace(/[^a-zA-Z0-9]/g, '').toUpperCase();
    }

    private static getCountrySpec(country?: Country | null): { prefix: string; length: number } | null {
        if (!country) {
            return null;
        }

        switch (country) {
            case Country.France:
                return { prefix: 'FR', length: this.IBAN_LENGTHS.FR };
            case Country.Germany:
                return { prefix: 'DE', length: this.IBAN_LENGTHS.DE };
            case Country.England:
                return { prefix: 'GB', length: this.IBAN_LENGTHS.GB };
            default:
                return null;
        }
    }

    private static hasValidChecksum(iban: string): boolean {
        const rear = iban.substring(4) + iban.substring(0, 4);

        let remainder = 0;
        for (const ch of rear) {
            const digits = /[A-Z]/.test(ch)
                ? String(ch.charCodeAt(0) - 'A'.charCodeAt(0) + 10)
                : ch;

            for (const d of digits) {
                remainder = (remainder * 10 + (d.charCodeAt(0) - '0'.charCodeAt(0))) % 97;
            }
        }

        return remainder === 1;
    }

    static validateIban(iban?: string | null, country?: Country | null): string[] {
        const errors: string[] = [];

        if (!iban || iban.trim() === '') {
            return errors;
        }

        const cleanedIban = this.clean(iban);

        if (!this.BASIC_IBAN_REGEX.test(cleanedIban)) {
            errors.push('IBAN format is invalid (expected: 2 letters country + 2 digits + alphanumerics).');
            return errors;
        }

        if (country !== null && country !== undefined) {
            const spec = this.getCountrySpec(country);

            if (!spec) {
                errors.push('IBAN country is not supported.');
            } else if (
                !cleanedIban.startsWith(spec.prefix) ||
                cleanedIban.length !== spec.length
            ) {
                errors.push(
                    `IBAN must start with '${spec.prefix}' and be ${spec.length} characters for ${country}.`
                );
            }
        }

        if (!this.hasValidChecksum(cleanedIban)) {
            errors.push('IBAN checksum is invalid.');
        }

        return errors;
    }
}