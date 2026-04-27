import type { Domain } from 'onlinepayments-sdk-nodejs';
import { ProtectionEligibility } from '../../../business/domain/payments/payment-details/protection-eligibility';

type ProtectionEligibilitySdk = Domain.ProtectionEligibility;

export const ProtectionEligibilityMapper = {
    fromSdkResponse: (response?: ProtectionEligibilitySdk | null): ProtectionEligibility | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            eligibility: response?.eligibility,
            type: response?.type,
        };
    },
};
