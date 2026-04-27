import type { Domain } from 'onlinepayments-sdk-nodejs';
import { AcquirerSelectionInformation } from '../../../business/domain/payments/payment-details/acquirer-selection-information';

type AcquirerSelectionInformationSdk = Domain.AcquirerSelectionInformation;

export const AcquirerSelectionInformationMapper = {
    fromSdkResponse: (response?: AcquirerSelectionInformationSdk | null): AcquirerSelectionInformation | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            fallbackLevel: response?.fallbackLevel,
            ruleName: response?.ruleName,
            result: response?.result,
        };
    },
};
