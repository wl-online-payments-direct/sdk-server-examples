import type { Domain } from 'onlinepayments-sdk-nodejs';
import { AmountOfMoney } from '../../../business/domain/payments/payment-details/amount-of-money';

type AmountOfMoneySdk = Domain.AmountOfMoney;

export const AmountOfMoneyMapper = {
    fromSdkResponse: (response?: AmountOfMoneySdk | null): AmountOfMoney | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            amount: response?.amount,
            currencyCode: response?.currencyCode,
        };
    },
};
