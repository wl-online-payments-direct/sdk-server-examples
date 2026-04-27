import type { Domain } from 'onlinepayments-sdk-nodejs';
import { PaymentProduct3203SpecificOutput } from '../../../business/domain/payments/payment-details/payment-product-320-specific-output';
import { AddressPersonalMapper } from './address-personal-mapper';

type PaymentProduct3203SpecificOutputSdk = Domain.PaymentProduct3203SpecificOutput;

export const PaymentProduct3203SpecificOutputMapper = {
    fromSdkResponse: (
        response?: PaymentProduct3203SpecificOutputSdk | null,
    ): PaymentProduct3203SpecificOutput | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            billingAddress: AddressPersonalMapper.fromSdkResponse(response?.billingAddress),
            shippingAddress: AddressPersonalMapper.fromSdkResponse(response?.shippingAddress),
        };
    },
};
