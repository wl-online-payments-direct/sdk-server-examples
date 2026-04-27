import type { Domain } from 'onlinepayments-sdk-nodejs';
import { CustomerDeviceOutput } from '../../../business/domain/payments/payment-details/customer-device-output';

type CustomerDeviceOutputSdk = Domain.CustomerDeviceOutput;

export const CustomerDeviceOutputMapper = {
    fromSdkResponse: (response?: CustomerDeviceOutputSdk | null): CustomerDeviceOutput | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            ipAddressCountryCode: response?.ipAddressCountryCode,
        };
    },
};
