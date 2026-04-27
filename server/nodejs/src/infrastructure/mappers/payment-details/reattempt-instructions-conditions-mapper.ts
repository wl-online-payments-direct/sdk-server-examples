import type { Domain } from 'onlinepayments-sdk-nodejs';
import { ReattemptInstructionsConditions } from '../../../business/domain/payments/payment-details/reattempt-instructions-conditions';

type ReattemptInstructionsConditionsSdk = Domain.ReattemptInstructionsConditions;

export const ReattemptInstructionsConditionsMapper = {
    fromSdkResponse: (
        response?: ReattemptInstructionsConditionsSdk | null,
    ): ReattemptInstructionsConditions | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            maxAttempts: response?.maxAttempts,
            maxDelay: response?.maxDelay,
        };
    },
};
