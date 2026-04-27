import { Currency } from '../../../domain/common/enums/currency';

export type AdditionalPaymentActionRequestDto = {
    amount?: number | null;
    currency?: Currency | null;
    isFinal?: boolean | null;
    id?: string | null;
};
