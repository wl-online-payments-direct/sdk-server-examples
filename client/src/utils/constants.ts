import type { MandateRecurrenceType, MandateSignatureType } from '../models/Mandate.ts';
import type { AdditionalPaymentAction } from '../models/AdditionalPayment.ts';

export const LANGUAGE_OPTIONS = [
    { label: 'English', value: 'English' },
    { label: 'German', value: 'German' },
    { label: 'French', value: 'French' },
];

export const COUNTRY_OPTIONS = [
    { label: '', value: null },
    { label: 'England', value: 'England' },
    { label: 'Germany', value: 'Germany' },
    { label: 'France', value: 'France' },
];

export const CURRENCY_OPTIONS = [
    { label: 'EUR', value: 'EUR' },
    { label: 'USD', value: 'USD' },
];

export const VALID_FOR_OPTIONS = [
    { label: '24h', value: '24' },
    { label: '48h', value: '48' },
    { label: '14 days', value: '336' },
    { label: '30 days', value: '720' },
];

export const RECURRENCE_TYPES: { label: string; value: MandateRecurrenceType }[] = [
    { label: 'Unique', value: 'UNIQUE' },
    { label: 'Recurring', value: 'RECURRING' },
];

export const SIGNATURE_TYPES: { label: string; value: MandateSignatureType }[] = [
    { label: 'SMS', value: 'SMS' },
    { label: 'UNSIGNED', value: 'UNSIGNED' },
];

export const ADDITIONAL_PAYMENT_ACTIONS: { label: string; value: AdditionalPaymentAction }[] = [
    { label: 'Cancel Payment', value: 'cancels' },
    { label: 'Capture Payment', value: 'captures' },
    { label: 'Refund Payment', value: 'refunds' },
];

export const IS_FINAL_OPTIONS = [
    { label: 'Yes', value: 'yes' },
    { label: 'No', value: 'no' },
];

export const MONTH_OPTIONS = [
    { label: '01', value: '01' },
    { label: '02', value: '02' },
    { label: '03', value: '03' },
    { label: '04', value: '04' },
    { label: '05', value: '05' },
    { label: '06', value: '06' },
    { label: '07', value: '07' },
    { label: '08', value: '08' },
    { label: '09', value: '09' },
    { label: '10', value: '10' },
    { label: '11', value: '11' },
    { label: '12', value: '12' },
];

export const YEAR_OPTIONS = [
    { label: '2025', value: '2025' },
    { label: '2026', value: '2026' },
    { label: '2027', value: '2027' },
    { label: '2028', value: '2028' },
    { label: '2029', value: '2029' },
    { label: '2030', value: '2030' },
    { label: '2031', value: '2031' },
    { label: '2032', value: '2032' },
    { label: '2033', value: '2033' },
    { label: '2034', value: '2034' },
    { label: '2035', value: '2035' },
    { label: '2036', value: '2036' },
];
