import type { Address } from './Address.ts';
import type { PaymentMethod } from './Payment.ts';

export type HostedTokenizationPayment = {
    amount: number;
    currency: string;
    hostedTokenizationId?: string;
    billingAddress?: Address;
    shippingAddress?: Address;
    method: PaymentMethod;
};
