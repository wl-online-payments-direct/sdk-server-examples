import type { Domain } from 'onlinepayments-sdk-nodejs';
import { PaymentProduct5001SpecificOutput } from '../../../business/domain/payments/payment-details/payment-product-5001-specific-output';

type PaymentProduct5001SpecificOutputSdk = Domain.PaymentProduct5001SpecificOutput;

export const PaymentProduct5001SpecificOutputMapper = {
    fromSdkResponse: (
        response?: PaymentProduct5001SpecificOutputSdk | null,
    ): PaymentProduct5001SpecificOutput | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            liability: response?.liability,
            accountNumber: response?.accountNumber,
            authorisationCode: response?.authorisationCode,
            operationCode: response?.operationCode,
            mobilePhoneNumber: response?.mobilePhoneNumber,
        };
    },
};
