import { Status } from '../../domain/common/enums/status';
import { Currency } from '../../domain/common/enums/currency';

export type CreatePaymentLinkResponseDto = {
    paymentLinkId?: string | null;
    redirectUrl?: string | null;
    status?: Status | null;
    amount?: number | null;
    currency?: Currency | null;
};
