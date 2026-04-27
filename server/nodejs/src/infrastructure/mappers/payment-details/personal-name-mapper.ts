import type { Domain } from 'onlinepayments-sdk-nodejs';
import { PersonalName } from '../../../business/domain/payments/payment-details/personal-name';

type PersonalNameSdk = Domain.PersonalName;

export const PersonalNameMapper = {
    fromSdkResponse: (response?: PersonalNameSdk | null): PersonalName | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            surname: response?.surname,
            firstName: response?.firstName,
            title: response?.title,
        };
    },
};
