import type { Domain } from 'onlinepayments-sdk-nodejs';
import { CardEssentials } from '../../../business/domain/payments/payment-details/card-essentials';

type CardEssentialsSdk = Domain.CardEssentials;

export const CardEssentialsMapper = {
    fromSdkResponse: (response?: CardEssentialsSdk | null): CardEssentials | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            countryCode: response?.countryCode,
            cardNumber: response?.cardNumber,
            expiryDate: response?.expiryDate,
            bin: response?.bin,
        };
    },
};
