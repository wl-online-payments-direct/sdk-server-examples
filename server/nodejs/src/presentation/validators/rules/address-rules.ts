import { Country } from '../../../business/domain/common/enums/country';
import { AddressDto } from '../../../business/dtos/common/address-dto';
import { EnumUtils } from '../../utils/enum-utils';
import { ZipRules } from './zip-rules';

export class AddressRules {
    static validateAddress(address: AddressDto | null | undefined, prefix: string): string[] {
        const errors: string[] = [];

        if (!address) {
            return errors;
        }

        const firstName = (address.firstName || '').trim();
        const lastName = (address.lastName || '').trim();
        const countryStr = (address.country || '').trim();
        const zip = (address.zip || '').trim();
        const city = (address.city || '').trim();
        const street = (address.street || '').trim();

        if (!firstName) errors.push(`The ${prefix}.FirstName field is required.`);
        if (!lastName) errors.push(`The ${prefix}.LastName field is required.`);

        let countryEnum: Country | undefined;
        if (!countryStr) {
            errors.push(`The ${prefix}.Country field is required.`);
        } else {
            countryEnum = EnumUtils.toEnum(Country, countryStr) as Country | undefined;
            if (!countryEnum) {
                errors.push(`The ${prefix}.Country field is invalid.`);
            }
        }

        if (!zip) {
            errors.push(`The ${prefix}.Zip field is required.`);
        } else if (countryEnum) {
            errors.push(...ZipRules.validateZipForCountry(zip, countryEnum));
        }

        if (!city) errors.push(`The ${prefix}.City field is required.`);
        if (!street) errors.push(`The ${prefix}.Street field is required.`);

        return errors;
    }
}