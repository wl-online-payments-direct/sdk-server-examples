import type { Domain } from 'onlinepayments-sdk-nodejs';
import { SurchargeSpecificOutput } from '../../../business/domain/payments/payment-details/surcharge-specific-output';
import { SurchargeRateMapper } from './surcharge-rate-mapper';
import { AmountOfMoneyMapper } from './amount-of-money-mapper';

type SurchargeSpecificOutputSdk = Domain.SurchargeSpecificOutput;

export const SurchargeSpecificOutputMapper = {
    fromSdkResponse: (response?: SurchargeSpecificOutputSdk | null): SurchargeSpecificOutput | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            surchargeRate: SurchargeRateMapper.fromSdkResponse(response?.surchargeRate),
            surchargeAmount: AmountOfMoneyMapper.fromSdkResponse(response?.surchargeAmount),
            mode: response?.mode,
        };
    },
};
