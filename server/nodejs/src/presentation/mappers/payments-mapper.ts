import { Currency } from '../../business/domain/common/enums/currency';
import { PaymentMethodType } from '../../business/domain/enums/payments/payment-method-type';
import { CreatePaymentRequest } from '../models/payment/create-payment/create-payment-request';
import { CreatePaymentRequestDto } from '../../business/dtos/payment/create-payment/create-payment-request-dto';
import { CreatePaymentResponse } from '../models/payment/create-payment/create-payment-response';
import { CreatePaymentResponseDto } from '../../business/dtos/payment/create-payment/create-payment-response-dto';
import { EnumUtils } from '../utils/enum-utils';
import { SMALLEST_UNIT } from '../../constants';

export const PaymentMapper = {
    toDto(request: CreatePaymentRequest): CreatePaymentRequestDto {
        return {
            amount: Math.round((request.amount ?? 0) * SMALLEST_UNIT),
            currency: EnumUtils.toEnum(Currency, request.currency) as Currency,
            method: EnumUtils.toEnum(PaymentMethodType, request.method) as PaymentMethodType,
            hostedTokenizationId: request.hostedTokenizationId,
            shippingAddress: request.shippingAddress,
            billingAddress: request.billingAddress,
            card: request.card,
            mandate: request.mandate,
        };
    },

    fromDto(responseDto: CreatePaymentResponseDto): CreatePaymentResponse {
        return {
            id: responseDto.id,
            status: responseDto.status,
            statusOutput: responseDto.statusOutput,
        };
    },
};
