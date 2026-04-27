import type { Domain } from 'onlinepayments-sdk-nodejs';
import { PaymentReferences } from '../../../business/domain/payments/payment-details/payment-references';

type PaymentReferencesSdk = Domain.PaymentReferences;

export const PaymentReferencesMapper = {
    fromSdkResponse: (response?: PaymentReferencesSdk | null): PaymentReferences | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            merchantParameters: response?.merchantParameters ?? null,
            merchantReference: response?.merchantReference ?? null,
        };
    },
};
