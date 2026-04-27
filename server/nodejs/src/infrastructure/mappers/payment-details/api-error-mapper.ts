import type { Domain } from 'onlinepayments-sdk-nodejs';
import { APIError } from '../../../business/domain/payments/payment-details/api-error';

type APIErrorSdk = Domain.APIError;

export const ApiErrorMapper = {
    fromSdkResponse: (response?: APIErrorSdk): APIError | undefined => {
        if (!response) {
            return undefined;
        }

        return {
            message: response?.message,
            errorCode: response?.errorCode,
            propertyName: response?.propertyName,
            httpStatusCode: response?.httpStatusCode,
            retriable: response?.retriable,
            category: response?.category,
            id: response?.id,
        };
    },
};
