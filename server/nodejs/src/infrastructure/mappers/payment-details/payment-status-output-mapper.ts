import type { Domain } from 'onlinepayments-sdk-nodejs';
import { APIError } from '../../../business/domain/payments/payment-details/api-error';
import { ApiErrorMapper } from './api-error-mapper';
import { PaymentStatusOutput } from '../../../business/domain/payments/payment-details/payment-status-output';

type PaymentStatusOutputSdk = Domain.PaymentStatusOutput;
type APIErrorSdk = Domain.APIError;

export const PaymentStatusOutputMapper = {
    fromSdkResponse: (response?: PaymentStatusOutputSdk | null): PaymentStatusOutput | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            isAuthorized: response?.isAuthorized,
            isCancellable: response?.isCancellable,
            isRefundable: response?.isRefundable,
            statusCategory: response?.statusCategory,
            statusCode: response?.statusCode,
            statusCodeChangeDateTime: response?.statusCodeChangeDateTime,
            errors: mapList(response?.errors),
        };
    },
};

const mapList = (errors?: APIErrorSdk[] | null): APIError[] | undefined => {
    return errors?.map((error) => ApiErrorMapper.fromSdkResponse(error)).filter((error): error is APIError => !!error);
};
