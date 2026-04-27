import type { Domain } from 'onlinepayments-sdk-nodejs';
import { ThreeDSecureResults } from '../../../business/domain/payments/payment-details/three-d-secure-results';

type ThreeDSecureResultsSdk = Domain.ThreeDSecureResults;

export const ThreeDSecureResultsMapper = {
    fromSdkResponse: (response?: ThreeDSecureResultsSdk | null): ThreeDSecureResults | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            cavv: response?.cavv,
            appliedExemption: response?.appliedExemption,
            authenticationStatus: response?.authenticationStatus,
            challengeIndicator: response?.challengeIndicator,
            schemeEci: response?.schemeEci,
            acsTransactionId: response?.acsTransactionId,
            dsTransactionId: response?.dsTransactionId,
            exemptionEngineFlow: response?.exemptionEngineFlow,
            liability: response?.liability,
            eci: response?.eci,
            flow: response?.flow,
            version: response?.version,
            xid: response?.xid,
        };
    },
};
