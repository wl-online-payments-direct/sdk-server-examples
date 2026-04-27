import type { Domain } from 'onlinepayments-sdk-nodejs';
import { PaymentProduct3208SpecificOutput } from '../../../business/domain/payments/payment-details/payment-produc-3208-specific-output';

type PaymentProduct3208SpecificOutputSdk = Domain.PaymentProduct3208SpecificOutput;

export const PaymentProduct3208SpecificOutputMapper = {
    fromSdkResponse: (
        response?: PaymentProduct3208SpecificOutputSdk | null,
    ): PaymentProduct3208SpecificOutput | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            buyerCompliantBankMessage: response?.buyerCompliantBankMessage,
        };
    },
};
