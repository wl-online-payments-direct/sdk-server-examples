export type PaymentLinkAction = 'PREVIEW' | 'CREATE';
type PaymentLinkStatus = 'ACTIVE' | 'PAID' | 'CANCELLED' | 'EXPIRED';

export type PaymentLink = {
    amount: number;
    currency: string;
    description?: string;
    validFor: string;
    action: PaymentLinkAction;
};

export type PaymentLinkResponse = {
    redirectUrl: string;
    paymentLinkId: string;
    status: PaymentLinkStatus;
    amount: number;
    currency: string;
};
