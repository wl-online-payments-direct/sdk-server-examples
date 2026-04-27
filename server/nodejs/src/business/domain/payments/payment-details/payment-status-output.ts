import { APIError } from './api-error';

export type PaymentStatusOutput = {
    errors?: APIError[] | null;
    isAuthorized?: boolean | null;
    isCancellable?: boolean | null;
    isRefundable?: boolean | null;
    statusCategory?: string | null;
    statusCode?: number | null;
    statusCodeChangeDateTime?: string | null;
};
