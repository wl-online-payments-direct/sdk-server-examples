import type { Domain } from 'onlinepayments-sdk-nodejs';
import { FraudResults } from '../../../business/domain/payments/payment-details/fraud-results';

type FraudResultsSdk = Domain.FraudResults;

export const FraudResultsMapper = {
    fromSdkResponse: (response?: FraudResultsSdk | null): FraudResults | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            fraudServiceResult: response?.fraudServiceResult,
        };
    },
};
