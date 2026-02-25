import type { Mandate } from './Mandate.ts';
import type { PaymentMethod } from './Payment.ts';

export type CreditCardDebitPayment = {
    amount: number;
    currency: string;
    mandate: Mandate;
    method: PaymentMethod;
};
