import { AdditionalPaymentActionRequest } from '../models/payment/additional-payment-action/additional-payment-action-request';
import { AdditionalPaymentActionRequestDto } from '../../business/dtos/payment/additional-payment-action/additional-payment-action-request-dto';
import { AdditionalPaymentActionResponse } from '../models/payment/additional-payment-action/additional-payment-action-response';
import { AdditionalPaymentActionResponseDto } from '../../business/dtos/payment/additional-payment-action/additional-payment-action-response-dto';
import { Currency } from '../../business/domain/common/enums/currency';
import { EnumUtils } from '../utils/enum-utils';
import { SMALLEST_UNIT } from '../../constants';

export const AdditionalPaymentActionMapper = {
    toDto: (request: AdditionalPaymentActionRequest): AdditionalPaymentActionRequestDto => {
        return {
            amount: Math.round((request?.amount ?? 0) * SMALLEST_UNIT),
            currency: EnumUtils.toEnum(Currency, request?.currency) as Currency,
            isFinal: request?.isFinal,
        };
    },

    fromDto: (dto: AdditionalPaymentActionResponseDto | null | undefined): AdditionalPaymentActionResponse => {
        const response: AdditionalPaymentActionResponse = {};

        if (!dto) {
            return response;
        }

        return {
            id: dto.id,
            status: dto.status,
            statusOutput: dto.statusOutput,
        };
    },
};
