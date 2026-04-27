import type { Domain } from 'onlinepayments-sdk-nodejs';
import { AddressPersonal } from '../../../business/domain/payments/payment-details/address-personal';
import { PersonalNameMapper } from './personal-name-mapper';

type AddressPersonalSdk = Domain.AddressPersonal;

export const AddressPersonalMapper = {
    fromSdkResponse: (response?: AddressPersonalSdk | null): AddressPersonal | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            additionalInfo: response?.additionalInfo,
            city: response?.city,
            countryCode: response?.countryCode,
            houseNumber: response?.houseNumber,
            companyName: response?.companyName,
            name: PersonalNameMapper.fromSdkResponse(response?.name),
            state: response?.state,
            zip: response?.zip,
            street: response?.street,
        };
    },
};
