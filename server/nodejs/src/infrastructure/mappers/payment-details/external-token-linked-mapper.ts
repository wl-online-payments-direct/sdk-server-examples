import type { Domain } from 'onlinepayments-sdk-nodejs';
import { ExternalTokenLinked } from '../../../business/domain/payments/payment-details/external-token-linked';

type ExternalTokenLinkedSdk = Domain.ExternalTokenLinked;

export const ExternalTokenLinkedMapper = {
    fromSdkResponse: (response?: ExternalTokenLinkedSdk | null): ExternalTokenLinked | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            computedToken: response?.ComputedToken,
            generatedToken: response?.GeneratedToken,
        };
    },
};
