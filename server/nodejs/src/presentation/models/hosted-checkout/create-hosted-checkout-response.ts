import { Currency } from '../../../business/domain/common/enums/currency';

export interface CreateHostedCheckoutResponse {
    hostedCheckoutId?: string | null;
    redirectUrl?: string | null;
    returnMAC?: string | null;
    amount?: number | null;
    currency?: Currency | null;
}
