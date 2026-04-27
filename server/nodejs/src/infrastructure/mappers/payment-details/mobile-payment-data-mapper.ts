import type { Domain } from 'onlinepayments-sdk-nodejs';
import { MobilePaymentData } from '../../../business/domain/payments/payment-details/mobile-payment-data';

type MobilePaymentDataSdk = Domain.MobilePaymentData;

export const MobilePaymentDataMapper = {
    fromSdkResponse: (response?: MobilePaymentDataSdk | null): MobilePaymentData | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            dpan: response?.dpan,
            expiryDate: response?.expiryDate,
        };
    },
};
