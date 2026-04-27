import { SurchargeRate } from './surcharge-rate';
import { AmountOfMoney } from './amount-of-money';

export type SurchargeSpecificOutput = {
    mode?: string | null;
    surchargeAmount?: AmountOfMoney | null;
    surchargeRate?: SurchargeRate | null;
};
