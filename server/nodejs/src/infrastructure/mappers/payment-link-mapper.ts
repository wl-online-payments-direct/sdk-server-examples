import { randomUUID } from 'crypto';
import { CreatePaymentLinkRequestDto } from '../../business/dtos/payment-link/create-payment-link-request-dto';
import { CreatePaymentLinkResponseDto } from '../../business/dtos/payment-link/create-payment-link-response-dto';
import { Currency } from '../../business/domain/common/enums/currency';
import { Status } from '../../business/domain/common/enums/status';
import { Domain } from 'onlinepayments-sdk-nodejs';
import { ValidFor } from '../../business/domain/enums/payment-links/validity-period';
import { EnumUtils } from '../../presentation/utils/enum-utils';

const getExpirationDate = (validFor?: ValidFor | null): string | undefined => {
    if (!validFor) {
        return undefined;
    }

    const hours = parseInt(validFor, 10);

    const now = new Date();
    now.setUTCHours(now.getUTCHours() + hours);
    return now.toISOString();
};

export const PaymentLinkMapper = {
    toSdkResponse(requestDto: CreatePaymentLinkRequestDto): Domain.CreatePaymentLinkRequest {
        return {
            order: {
                amountOfMoney: {
                    amount: requestDto.amount,
                    currencyCode: EnumUtils.fromEnum(Currency, requestDto.currency),
                },
                references: {
                    merchantReference: randomUUID().toString(),
                },
            },
            paymentLinkSpecificInput: {
                expirationDate: getExpirationDate(requestDto.validFor),
                description: requestDto.description,
            },
        };
    },

    fromSdkResponse(response: Domain.PaymentLinkResponse): CreatePaymentLinkResponseDto {
        return {
            redirectUrl: response?.redirectionUrl ?? null,
            paymentLinkId: response?.paymentLinkId ?? null,
            status: EnumUtils.toEnum(Status, response?.status?.toUpperCase()) as Status | null,
            amount: response?.paymentLinkOrder?.amount?.amount ?? null,
            currency: EnumUtils.toEnum(
                Currency,
                response?.paymentLinkOrder?.amount?.currencyCode?.toUpperCase(),
            ) as Currency | null,
        };
    },
};
