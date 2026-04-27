import type { Domain } from 'onlinepayments-sdk-nodejs';
import { CardFraudResults } from '../../../business/domain/payments/payment-details/card-fraud-results';

type CardFraudResultsSdk = Domain.CardFraudResults;

export const CardFraudResultsMapper = {
    fromSdkResponse: (response?: CardFraudResultsSdk | null): CardFraudResults | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            avsResult: response?.avsResult,
            fraudServiceResult: response?.fraudServiceResult,
            cvvResult: response?.cvvResult,
        };
    },
};
