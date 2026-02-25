import type { Address } from './Address.ts';
import type { PaymentMethod } from './Payment.ts';

export type CreditCard = {
    number: string;
    holderName: string;
    verificationCode: string;
    expiryMonth: string;
    expiryYear: string;
};

export type CreditCardPayment = {
    amount: number;
    currency: string;
    card: CreditCard;
    billingAddress?: Address;
    shippingAddress?: Address;
    method: PaymentMethod;
};
