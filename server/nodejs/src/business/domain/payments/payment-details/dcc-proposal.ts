import { AmountOfMoney } from './amount-of-money';
import { RateDetails } from './rate-details';

export type DccProposal = {
    baseAmount?: AmountOfMoney | null;
    disclaimerDisplay?: string | null;
    disclaimerReceipt?: string | null;
    rate?: RateDetails | null;
    targetAmount?: AmountOfMoney | null;
};
