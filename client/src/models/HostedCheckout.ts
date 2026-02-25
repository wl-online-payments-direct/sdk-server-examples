import type { Address } from './Address.ts';

export type HostedCheckout = {
    amount: number;
    currency: string;
    language?: string;
    redirectUrl?: string;
    billingAddress?: Address;
    shippingAddress?: Address;
};

export type HostedCheckoutResponse = {
    hostedCheckoutId: string;
    redirectUrl: string;
    returnMAC: string;
    amount: number;
    currency: string;
};

export type PaymentFromHostedCheckoutResponse = {
    paymentId: string;
    status: string;
};
