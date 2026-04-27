import { RecurrenceType } from '../enums/payments/recurrence-type';
import { AddressDto } from '../../dtos/common/address-dto';
import { SignatureType } from '../enums/payments/signature-type';

export type Mandate = {
    iban?: string | null;
    customerReference?: string | null;
    mandateReference?: string | null;
    recurrenceType?: RecurrenceType | null;
    signatureType?: SignatureType | null;
    returnUrl?: string | null;
    address?: AddressDto | null;
};
