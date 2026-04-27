import { Currency } from '../../domain/common/enums/currency';

export type CreateHostedCheckoutResponseDto = {
    hostedCheckoutId?: string | null;
    redirectUrl?: string | null;
    returnMAC?: string | null;
    amount?: number | null;
    currency?: Currency | null;
};
