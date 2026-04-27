import { Domain } from 'onlinepayments-sdk-nodejs';
import { SdkResponseError } from '../../business/errors/sdk-response-error';

export const ErrorMapper = {
    fromSdkError(sdkError: Domain.ErrorResponse | null, statusCode: number, message?: string): SdkResponseError {
        const apiError = sdkError?.errors?.[0];
        const errorMessage = message?.trim()
            ? message
            : apiError?.id?.trim()
              ? apiError?.id
              : apiError?.message?.trim()
                ? apiError?.message
                : `${apiError?.category ?? 'UNKNOWN'} (${apiError?.errorCode ?? 'UNKNOWN'})`;

        return new SdkResponseError(statusCode, errorMessage);
    },
};
