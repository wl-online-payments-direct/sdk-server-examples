import { Status } from '../../../business/domain/common/enums/status';
import { Currency } from '../../../business/domain/common/enums/currency';

export interface CreatePaymentLinkResponse {
    paymentLinkId?: string | null;
    redirectUrl?: string | null;
    status?: Status | null;
    amount?: number | null;
    currency?: Currency | null;
}
