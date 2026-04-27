import type { Domain } from 'onlinepayments-sdk-nodejs';
import { HostedCheckoutSpecificOutput } from '../../../business/domain/payments/payment-details/hosted-checkout-specific-output';

type HostedCheckoutSpecificOutputSdk = Domain.HostedCheckoutSpecificOutput;

export const HostedCheckoutSpecificOutputMapper = {
    fromSdkResponse: (response?: HostedCheckoutSpecificOutputSdk | null): HostedCheckoutSpecificOutput | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            variant: response?.variant ?? null,
            hostedCheckoutId: response?.hostedCheckoutId ?? null,
        };
    },
};