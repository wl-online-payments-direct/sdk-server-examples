export type PaymentOutcomeResponse = Record<string, unknown>;
export type PaymentMethod = 'TOKEN' | 'CREDIT_CARD' | 'DIRECT_DEBIT';

type PaymentStatus =
    | 'CREATED'
    | 'CANCELLED'
    | 'REJECTED'
    | 'REJECTED_CAPTURE'
    | 'REDIRECTED'
    | 'PENDING_PAYMENT'
    | 'PENDING_COMPLETION'
    | 'PENDING_CAPTURE'
    | 'AUTHORIZATION_REQUESTED'
    | 'CAPTURE_REQUESTED'
    | 'CAPTURED'
    | 'REVERSED'
    | 'REFUND_REQUESTED'
    | 'REFUNDED';

type PaymentStatusCategory =
    | 'CREATED'
    | 'UNSUCCESSFUL'
    | 'PENDING_PAYMENT'
    | 'PENDING_MERCHANT'
    | 'PENDING_CONNECT_OR_3RD_PARTY'
    | 'COMPLETED'
    | 'REVERSED'
    | 'REFUNDED';

export type PaymentResponse = {
    id: string;
    status: PaymentStatus;
    statusOutput: {
        statusCode: number;
        statusCategory: PaymentStatusCategory;
    };
};
