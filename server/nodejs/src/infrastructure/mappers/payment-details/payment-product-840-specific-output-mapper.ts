import type { Domain } from 'onlinepayments-sdk-nodejs';
import { AddressMapper } from './address-mapper';
import { PaymentProduct840CustomerAccountMapper } from './payment-product-840-customer-account-mapper';
import { PaymentProduct840SpecificOutput } from '../../../business/domain/payments/payment-details/payment-product-840-specific-output';
import { ProtectionEligibilityMapper } from './protection-eligibility-mapper';

type PaymentProduct840SpecificOutputSdk = Domain.PaymentProduct840SpecificOutput;

export const PaymentProduct840SpecificOutputMapper = {
    fromSdkResponse: (
        response?: PaymentProduct840SpecificOutputSdk | null,
    ): PaymentProduct840SpecificOutput | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            billingAddress: AddressMapper.fromSdkResponse(response?.billingAddress),
            customerAccount: PaymentProduct840CustomerAccountMapper.fromSdkResponse(response?.customerAccount),
            customerAddress: AddressMapper.fromSdkResponse(response?.customerAddress),
            protectionEligibility: ProtectionEligibilityMapper.fromSdkResponse(response?.protectionEligibility),
        };
    },
};
