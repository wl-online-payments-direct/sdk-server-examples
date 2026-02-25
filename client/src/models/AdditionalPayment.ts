export type AdditionalPaymentAction = 'captures' | 'refunds' | 'cancels';

export type AdditionalPayment = {
    amount: number;
    currency: string;
    isFinal?: boolean;
};
