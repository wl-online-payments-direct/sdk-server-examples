import type { Domain } from 'onlinepayments-sdk-nodejs';
import { CustomerBankAccount } from '../../../business/domain/payments/payment-details/customer-bank-account';

type CustomerBankAccountSdk = Domain.CustomerBankAccount;

export const CustomerBankAccountMapper = {
    fromSdkResponse: (response?: CustomerBankAccountSdk | null): CustomerBankAccount | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            accountHolderName: response?.accountHolderName,
            bic: response?.bic,
            iban: response?.iban,
        };
    },
};
