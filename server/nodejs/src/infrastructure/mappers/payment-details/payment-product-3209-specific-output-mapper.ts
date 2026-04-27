import type { Domain } from 'onlinepayments-sdk-nodejs';
import { PaymentProduct3209SpecificOutput } from '../../../business/domain/payments/payment-details/payment-product-3209-specific-output';

type PaymentProduct3209SpecificOutputSdk = Domain.PaymentProduct3209SpecificOutput;

export const PaymentProduct3209SpecificOutputMapper = {
    fromSdkResponse: (
        response?: PaymentProduct3209SpecificOutputSdk | null,
    ): PaymentProduct3209SpecificOutput | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            buyerCompliantBankMessage: response?.buyerCompliantBankMessage,
        };
    },
};
