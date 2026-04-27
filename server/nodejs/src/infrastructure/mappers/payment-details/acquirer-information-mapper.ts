import type { Domain } from 'onlinepayments-sdk-nodejs';
import { AcquirerInformation } from '../../../business/domain/payments/payment-details/acquirer-information';
import { AcquirerSelectionInformationMapper } from './acquirer-selection-information-mapper';

type AcquirerInformationSdk = Domain.AcquirerInformation;

export const AcquirerInformationMapper = {
    fromSdkResponse: (response?: AcquirerInformationSdk | null): AcquirerInformation | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            acquirerSelectionInformation: AcquirerSelectionInformationMapper.fromSdkResponse(
                response?.acquirerSelectionInformation,
            ),
            name: response?.name,
        };
    },
};
