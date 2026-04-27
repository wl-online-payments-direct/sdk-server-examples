import { Mandate } from '../../../business/domain/payments/mandate';
import { RecurrenceType } from '../../../business/domain/enums/payments/recurrence-type';
import { IbanRules } from './iban-rules';
import { SignatureType } from '../../../business/domain/enums/payments/signature-type';
import { AddressRules } from './address-rules';
import { EnumUtils } from '../../utils/enum-utils';
import { UrlRules } from './url-rules';

export class MandateRules {
    static validateMandate(mandate?: Mandate | null): string[] {
        const errors: string[] = [];

        if (!mandate) {
            errors.push('The Mandate field is required.');
            return errors;
        }

        const customerReference = mandate.customerReference?.trim() || '';
        const mandateReference = mandate.mandateReference?.trim() || '';
        const iban = mandate.iban?.trim() || '';
        const recurrenceType = mandate.recurrenceType;
        const signatureType = mandate.signatureType;
        const returnUrl = mandate.returnUrl?.trim() || '';
        const address = mandate.address;

        if (!customerReference) {
            errors.push('The CustomerReference field is required.');
        } else if (customerReference.length > 35) {
            errors.push('The CustomerReference field must be shorter than 36 characters.');
        }

        if (!mandateReference && !iban) {
            errors.push('IBAN is required when mandate reference is not provided.');
        }

        if (!recurrenceType) {
            errors.push('The RecurrenceType field is required.');
        } else if (
            !EnumUtils.isInAllowedValues(RecurrenceType, recurrenceType, [
                RecurrenceType.UNIQUE,
                RecurrenceType.RECURRING,
            ])
        ) {
            errors.push('The RecurrenceType field is invalid.');
        }

        if (!signatureType) {
            errors.push('The SignatureType field is required.');
        } else if (
            !EnumUtils.isInAllowedValues(SignatureType, signatureType, [
                SignatureType.SMS,
                SignatureType.UNSIGNED,
                SignatureType.TICK_BOX,
            ])
        ) {
            errors.push('The SignatureType field is invalid.');
        }

        if (returnUrl && !UrlRules.validate(returnUrl)) {
            errors.push('The ReturnUrl field is invalid.');
        }

        if (!mandateReference) {
            if (!address) {
                errors.push('Address is required when mandate reference is not provided.');
            } else {
                const addressErrors = AddressRules.validateAddress(address, 'Mandate.Address');
                errors.push(...addressErrors);
            }
        }

        if (iban && !mandateReference) {
            if (iban.length > 50) {
                errors.push('The IBAN field must be shorter than 51 characters.');
            } else {
                errors.push(...IbanRules.validateIban(iban, address?.country));
            }
        }

        return errors;
    }
}
