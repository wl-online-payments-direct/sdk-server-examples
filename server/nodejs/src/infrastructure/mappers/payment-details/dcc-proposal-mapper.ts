import type { Domain } from 'onlinepayments-sdk-nodejs';
import { DccProposal } from '../../../business/domain/payments/payment-details/dcc-proposal';
import { AmountOfMoneyMapper } from './amount-of-money-mapper';
import { RateDetailsMapper } from './rate-details-mapper';

type DccProposalSdk = Domain.DccProposal;

export const DccProposalMapper = {
    fromSdkResponse: (response?: DccProposalSdk | null): DccProposal | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            rate: RateDetailsMapper.fromSdkResponse(response?.rate),
            baseAmount: AmountOfMoneyMapper.fromSdkResponse(response?.baseAmount),
            disclaimerDisplay: response?.disclaimerDisplay,
            disclaimerReceipt: response?.disclaimerReceipt,
            targetAmount: AmountOfMoneyMapper.fromSdkResponse(response?.targetAmount),
        };
    },
};
