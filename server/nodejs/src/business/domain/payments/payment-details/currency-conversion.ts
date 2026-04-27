import { DccProposal } from './dcc-proposal';

export type CurrencyConversion = {
    acceptedByUser?: boolean | null;
    proposal?: DccProposal | null;
};
