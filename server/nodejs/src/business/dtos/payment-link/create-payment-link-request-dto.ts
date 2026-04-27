import { Currency } from '../../domain/common/enums/currency';
import { ValidFor } from '../../domain/enums/payment-links/validity-period';
import { Action } from '../../domain/enums/payment-links/action';

export type CreatePaymentLinkRequestDto = {
    amount?: number | null;
    currency?: Currency | null;
    description?: string | null;
    validFor?: ValidFor | null;
    action?: Action | null;
};
