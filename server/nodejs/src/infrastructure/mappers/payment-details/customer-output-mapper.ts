import type { Domain } from 'onlinepayments-sdk-nodejs';
import { CustomerOutput } from '../../../business/domain/payments/payment-details/customer-output';
import { CustomerDeviceOutputMapper } from './customer-device-output-mapper';

type CustomerOutputSdk = Domain.CustomerOutput;

export const CustomerOutputMapper = {
    fromSdkResponse: (response?: CustomerOutputSdk | null): CustomerOutput | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            device: CustomerDeviceOutputMapper.fromSdkResponse(response?.device),
        };
    },
};
