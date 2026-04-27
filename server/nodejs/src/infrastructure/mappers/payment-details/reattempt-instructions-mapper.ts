import type { Domain } from 'onlinepayments-sdk-nodejs';
import { ReattemptInstructions } from '../../../business/domain/payments/payment-details/reattempt-instructions';
import { ReattemptInstructionsConditionsMapper } from './reattempt-instructions-conditions-mapper';

type ReattemptInstructionsSdk = Domain.ReattemptInstructions;

export const ReattemptInstructionsMapper = {
    fromSdkResponse: (response?: ReattemptInstructionsSdk | null): ReattemptInstructions | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            conditions: ReattemptInstructionsConditionsMapper.fromSdkResponse(response?.conditions),
            frozenPeriod: response?.frozenPeriod,
            indicator: response?.indicator,
        };
    },
};
