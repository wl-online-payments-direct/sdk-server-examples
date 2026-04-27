import type { Domain } from 'onlinepayments-sdk-nodejs';
import { OperationPaymentReferences } from '../../../business/domain/payments/payment-details/operation-payment-references';

type OperationPaymentReferencesSdk = Domain.OperationPaymentReferences;

export const OperationPaymentReferencesMapper = {
    fromSdkResponse: (response?: OperationPaymentReferencesSdk | null): OperationPaymentReferences | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            merchantReference: response?.merchantReference,
        };
    },
};
