import type { Domain } from 'onlinepayments-sdk-nodejs';
import { Address } from '../../../business/domain/payments/payment-details/address';

type AddressSdk = Domain.Address;

export const AddressMapper = {
    fromSdkResponse: (response?: AddressSdk | null): Address | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            city: response?.city,
            countryCode: response?.countryCode,
            additionalInfo: response?.additionalInfo,
            houseNumber: response?.houseNumber,
            state: response?.state,
            street: response?.street,
            zip: response?.zip,
        };
    },
};
