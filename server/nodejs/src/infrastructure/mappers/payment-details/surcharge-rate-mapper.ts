import type { Domain } from 'onlinepayments-sdk-nodejs';
import { SurchargeRate } from '../../../business/domain/payments/payment-details/surcharge-rate';

type SurchargeRateSdk = Domain.SurchargeRate;

export const SurchargeRateMapper = {
    fromSdkResponse: (response?: SurchargeRateSdk | null): SurchargeRate | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            specificRate: response?.specificRate,
            adValoremRate: response?.adValoremRate,
            surchargeProductTypeVersion: response?.surchargeProductTypeVersion,
            surchargeProductTypeId: response?.surchargeProductTypeId,
        };
    },
};
