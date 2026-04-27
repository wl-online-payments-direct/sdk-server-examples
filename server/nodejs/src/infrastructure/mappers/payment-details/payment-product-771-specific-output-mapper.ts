import type { Domain } from 'onlinepayments-sdk-nodejs';
import { PaymentProduct771SpecificOutput } from '../../../business/domain/payments/payment-details/payment-product-771-specific-output';

type PaymentProduct771SpecificOutputSdk = Domain.PaymentProduct771SpecificOutput;

export const PaymentProduct771SpecificOutputMapper = {
    fromSdkResponse: (
        response?: PaymentProduct771SpecificOutputSdk | null,
    ): PaymentProduct771SpecificOutput | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            mandateReference: response?.mandateReference,
        };
    },
};
