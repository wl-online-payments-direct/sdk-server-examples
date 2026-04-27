import type { Domain } from 'onlinepayments-sdk-nodejs';
import { PaymentProduct5402SpecificOutput } from '../../../business/domain/payments/payment-details/payment-product-5402-specific-output';

type PaymentProduct5402SpecificOutputSdk = Domain.PaymentProduct5402SpecificOutput;

export const PaymentProduct5402SpecificOutputMapper = {
    fromSdkResponse: (
        response?: PaymentProduct5402SpecificOutputSdk | null,
    ): PaymentProduct5402SpecificOutput | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            brand: response?.brand,
        };
    },
};
