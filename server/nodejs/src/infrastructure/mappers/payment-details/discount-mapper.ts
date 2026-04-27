import type { Domain } from 'onlinepayments-sdk-nodejs';
import { Discount } from '../../../business/domain/payments/payment-details/discount';

type DiscountSdk = Domain.Discount;

export const DiscountMapper = {
    fromSdkResponse: (response?: DiscountSdk | null): Discount | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            amount: response?.amount,
        };
    },
};
