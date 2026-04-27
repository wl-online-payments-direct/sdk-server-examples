import { CreateHostedCheckoutRequest } from '../models/hosted-checkout/create-hosted-checkout-request';
import { CreateHostedCheckoutRequestDto } from '../../business/dtos/hosted-checkout/create-hosted-checkout-request-dto';
import { CreateHostedCheckoutResponseDto } from '../../business/dtos/hosted-checkout/create-hosted-checkout-response-dto';
import { CreateHostedCheckoutResponse } from '../models/hosted-checkout/create-hosted-checkout-response';
import { GetPaymentByHostedCheckoutResponseDto } from '../../business/dtos/hosted-checkout/get-payment-by-hosted-checkout-response-dto';
import { GetPaymentByHostedCheckoutResponse } from '../models/hosted-checkout/get-payment-by-hosted-checkout-response';
import { Currency } from '../../business/domain/common/enums/currency';
import { Language } from '../../business/domain/common/enums/language';
import { EnumUtils } from '../utils/enum-utils';
import { SMALLEST_UNIT } from '../../constants';

export const HostedCheckoutMapper = {
    toDto: (request: CreateHostedCheckoutRequest): CreateHostedCheckoutRequestDto => {
        return {
            amount: Math.round((request.amount ?? 0) * SMALLEST_UNIT),
            currency: EnumUtils.toEnum(Currency, request.currency) as Currency,
            language: EnumUtils.toEnum(Language, request.language) as Language,
            redirectUrl: request.redirectUrl,
            billingAddress: request.billingAddress,
            shippingAddress: request.shippingAddress,
        };
    },

    fromDto: (
        dto: CreateHostedCheckoutResponseDto,
        requestDto: CreateHostedCheckoutRequestDto,
    ): CreateHostedCheckoutResponse => {
        return {
            hostedCheckoutId: dto.hostedCheckoutId,
            redirectUrl: dto.redirectUrl,
            returnMAC: dto.returnMAC,
            amount: requestDto.amount,
            currency: requestDto.currency,
        };
    },

    fromPaymentDto: (dto: GetPaymentByHostedCheckoutResponseDto | null): GetPaymentByHostedCheckoutResponse => {
        return {
            status: dto?.status,
            paymentId: dto?.paymentId,
        };
    },
};
