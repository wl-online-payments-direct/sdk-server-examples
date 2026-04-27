import { Domain } from 'onlinepayments-sdk-nodejs';
import { AdditionalPaymentActionRequestDto } from '../../business/dtos/payment/additional-payment-action/additional-payment-action-request-dto';
import { AdditionalPaymentActionResponseDto } from '../../business/dtos/payment/additional-payment-action/additional-payment-action-response-dto';
import { Status } from '../../business/domain/enums/payments/status';
import { StatusCategory } from '../../business/domain/common/enums/status-category';
import { EnumUtils } from '../../presentation/utils/enum-utils';

const mapAmountOfMoney = (dto: AdditionalPaymentActionRequestDto): Domain.AmountOfMoney | undefined => {
    if (!dto.amount || !dto.currency) {
        return undefined;
    }

    return {
        amount: dto.amount,
        currencyCode: dto.currency,
    };
};

export const AdditionalPaymentActionMapper = {
    toSdkCaptureRequest: (dto: AdditionalPaymentActionRequestDto): Domain.CapturePaymentRequest => {
        return {
            amount: dto.amount ?? undefined,
            isFinal: dto.isFinal,
        };
    },

    toSdkRefundRequest: (dto: AdditionalPaymentActionRequestDto): Domain.RefundRequest => {
        return {
            amountOfMoney: mapAmountOfMoney(dto),
        };
    },

    toSdkCancelRequest: (dto: AdditionalPaymentActionRequestDto): Domain.CancelPaymentRequest => {
        return {
            amountOfMoney: mapAmountOfMoney(dto),
        };
    },

    fromSdkCaptureResponse: (response?: Domain.CaptureResponse): AdditionalPaymentActionResponseDto => {
        return {
            id: response?.id,
            status: (response?.status as Status) ?? null,
            statusOutput: {
                statusCode: response?.statusOutput?.statusCode ?? null,
                statusCategory: undefined,
            },
        };
    },

    fromSdkRefundResponse: (response?: Domain.RefundResponse): AdditionalPaymentActionResponseDto => {
        return {
            id: response?.id,
            status: (response?.status as Status) ?? null,
            statusOutput: {
                statusCode: response?.statusOutput?.statusCode ?? null,
                statusCategory:
                    (EnumUtils.toEnum(StatusCategory, response?.statusOutput?.statusCategory) as StatusCategory) ??
                    null,
            },
        };
    },

    fromSdkCancelResponse: (response?: Domain.CancelPaymentResponse): AdditionalPaymentActionResponseDto => {
        return {
            id: response?.payment?.id,
            status: (response?.payment?.status as Status) ?? null,
            statusOutput: {
                statusCode: response?.payment?.statusOutput?.statusCode ?? null,
                statusCategory:
                    (EnumUtils.toEnum(
                        StatusCategory,
                        response?.payment?.statusOutput?.statusCategory,
                    ) as StatusCategory) ?? null,
            },
        };
    },
};
