import type { Domain } from 'onlinepayments-sdk-nodejs';
import { RateDetails } from '../../../business/domain/payments/payment-details/rate-details';

type RateDetailsSdk = Domain.RateDetails;

export const RateDetailsMapper = {
    fromSdkResponse: (response?: RateDetailsSdk | null): RateDetails | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            source: response?.source,
            exchangeRate: response?.exchangeRate,
            invertedExchangeRate: response?.invertedExchangeRate,
            markUpRate: response?.markUpRate,
            quotationDateTime: response?.quotationDateTime,
        };
    },
};
