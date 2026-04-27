import type { Domain } from 'onlinepayments-sdk-nodejs';
import { PaymentProduct840CustomerAccount } from '../../../business/domain/payments/payment-details/payment-product-840-customer-account';

type PaymentProduct840CustomerAccountSdk = Domain.PaymentProduct840CustomerAccount;

export const PaymentProduct840CustomerAccountMapper = {
    fromSdkResponse: (
        response?: PaymentProduct840CustomerAccountSdk | null,
    ): PaymentProduct840CustomerAccount | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            accountId: response?.accountId,
            companyName: response?.companyName,
            countryCode: response?.countryCode,
            firstName: response?.firstName,
            customerAccountStatus: response?.customerAccountStatus,
            customerAddressStatus: response?.customerAddressStatus,
            payerId: response?.payerId,
            surname: response?.surname,
        };
    },
};
