import type { Domain } from 'onlinepayments-sdk-nodejs';
import { CurrencyConversion } from '../../../business/domain/payments/payment-details/currency-conversion';
import { DccProposalMapper } from './dcc-proposal-mapper';

type CurrencyConversionSdk = Domain.CurrencyConversion;

export const CurrencyConversionMapper = {
    fromSdkResponse: (response?: CurrencyConversionSdk | null): CurrencyConversion | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            acceptedByUser: response?.acceptedByUser,
            proposal: DccProposalMapper.fromSdkResponse(response?.proposal),
        };
    },
};
