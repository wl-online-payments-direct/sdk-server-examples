import type { Address } from './Address.ts';

export type MandateRecurrenceType = 'UNIQUE' | 'RECURRING';
export type MandateSignatureType = 'SMS' | 'UNSIGNED';

export type Mandate = {
    iban?: string;
    customerReference: string;
    mandateReference?: string;
    recurrenceType: MandateRecurrenceType;
    signatureType: MandateSignatureType;
    returnUrl?: string;
    address?: Address;
};
