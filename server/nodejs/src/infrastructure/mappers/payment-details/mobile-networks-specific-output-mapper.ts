import type { Domain } from 'onlinepayments-sdk-nodejs';
import { CardFraudResultsMapper } from './card-fraud-results-mapper';
import { MobilePaymentDataMapper } from './mobile-payment-data-mapper';
import { MobilePaymentMethodSpecificOutput } from '../../../business/domain/payments/payment-details/mobile-payment-method-specific-output';
import { ThreeDSecureResultsMapper } from './three-d-secure-results-mapper';

type MobilePaymentMethodSpecificOutputSdk = Domain.MobilePaymentMethodSpecificOutput;

export const MobilePaymentMethodSpecificOutputMapper = {
    fromSdkResponse: (
        response?: MobilePaymentMethodSpecificOutputSdk | null,
    ): MobilePaymentMethodSpecificOutput | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            network: response?.network,
            authorisationCode: response?.authorisationCode,
            paymentProductId: response?.paymentProductId,
            fraudResults: CardFraudResultsMapper.fromSdkResponse(response?.fraudResults),
            paymentData: MobilePaymentDataMapper.fromSdkResponse(response?.paymentData),
            threeDSecureResults: ThreeDSecureResultsMapper.fromSdkResponse(response?.threeDSecureResults),
        };
    },
};
