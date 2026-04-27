import { CreatePaymentLinkRequest } from '../models/payment-link/create-payment-link-request';
import { CreatePaymentLinkRequestDto } from '../../business/dtos/payment-link/create-payment-link-request-dto';
import { CreatePaymentLinkResponseDto } from '../../business/dtos/payment-link/create-payment-link-response-dto';
import { CreatePaymentLinkResponse } from '../models/payment-link/create-payment-link-response';
import { Currency } from '../../business/domain/common/enums/currency';
import { Action } from '../../business/domain/enums/payment-links/action';
import { ValidFor } from '../../business/domain/enums/payment-links/validity-period';
import { EnumUtils } from '../utils/enum-utils';
import { SMALLEST_UNIT } from '../../constants';

export const PaymentLinkMapper = {
    toDto: (request: CreatePaymentLinkRequest): CreatePaymentLinkRequestDto => {
        return {
            amount: Math.round((request.amount ?? 0) * SMALLEST_UNIT),
            currency: EnumUtils.toEnum(Currency, request.currency) as Currency,
            action: EnumUtils.toEnum(Action, request.action) as Action,
            description: request.description,
            validFor: EnumUtils.toEnum(ValidFor, request.validFor) as ValidFor,
        };
    },

    fromDto: (dto: CreatePaymentLinkResponseDto): CreatePaymentLinkResponse => {
        return {
            amount: dto.amount,
            currency: dto.currency,
            redirectUrl: dto.redirectUrl,
            paymentLinkId: dto.paymentLinkId,
            status: dto.status,
        };
    },
};
