import type { Domain } from 'onlinepayments-sdk-nodejs';
import { PaymentProduct5500SpecificOutput } from '../../../business/domain/payments/payment-details/payment-product-5500-specific-output';

type PaymentProduct5500SpecificOutputSdk = Domain.PaymentProduct5500SpecificOutput;

export const PaymentProduct5500SpecificOutputMapper = {
    fromSdkResponse: (
        response?: PaymentProduct5500SpecificOutputSdk | null,
    ): PaymentProduct5500SpecificOutput | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            paymentReference: response?.paymentReference,
            paymentEndDate: response?.paymentEndDate,
            paymentStartDate: response?.paymentStartDate,
            entityId: response?.entityId,
        };
    },
};
