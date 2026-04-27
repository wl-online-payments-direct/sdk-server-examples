import { Domain } from 'onlinepayments-sdk-nodejs';
import { CreateHostedCheckoutRequestDto } from '../../business/dtos/hosted-checkout/create-hosted-checkout-request-dto';
import { CreateHostedCheckoutResponseDto } from '../../business/dtos/hosted-checkout/create-hosted-checkout-response-dto';
import { GetPaymentByHostedCheckoutResponseDto } from '../../business/dtos/hosted-checkout/get-payment-by-hosted-checkout-response-dto';
import { LanguageUtil } from '../../business/utils/models/language-util';
import { CountryUtil } from '../../business/utils/models/country-util';

export const HostedCheckoutMapper = {
    toSdkRequest(requestDto: CreateHostedCheckoutRequestDto): Domain.CreateHostedCheckoutRequest {
        return {
            order: {
                amountOfMoney: {
                    amount: requestDto.amount,
                    currencyCode: requestDto.currency,
                },
                customer: {
                    personalInformation: {
                        name: {
                            firstName: requestDto.billingAddress?.firstName,
                            surname: requestDto.billingAddress?.lastName,
                        },
                    },
                    billingAddress: {
                        city: requestDto.billingAddress?.city,
                        countryCode: CountryUtil.toIsoAlpha2(requestDto.shippingAddress?.country),
                        street: requestDto.billingAddress?.street,
                        zip: requestDto.billingAddress?.zip,
                    },
                },
                shipping: {
                    address: {
                        city: requestDto.shippingAddress?.city,
                        countryCode: CountryUtil.toIsoAlpha2(requestDto.shippingAddress?.country),
                        street: requestDto.shippingAddress?.street,
                        zip: requestDto.shippingAddress?.zip,
                        name: {
                            firstName: requestDto.shippingAddress?.firstName,
                            surname: requestDto.shippingAddress?.lastName,
                        },
                    },
                },
            },
            hostedCheckoutSpecificInput: {
                returnUrl: requestDto.redirectUrl,
                locale: LanguageUtil.toLocale(requestDto.language, requestDto.billingAddress?.country),
            },
        };
    },

    fromSdkResponse(sdkResponse: Domain.CreateHostedCheckoutResponse): CreateHostedCheckoutResponseDto {
        return {
            hostedCheckoutId: sdkResponse.hostedCheckoutId,
            redirectUrl: sdkResponse.redirectUrl,
            returnMAC: sdkResponse.RETURNMAC,
            amount: undefined,
            currency: undefined,
        };
    },

    fromGetHostedCheckoutSdkResponse(
        sdkResponse: Domain.GetHostedCheckoutResponse,
    ): GetPaymentByHostedCheckoutResponseDto {
        return {
            paymentId: sdkResponse.createdPaymentOutput?.payment?.id,
            status: sdkResponse.status,
        };
    },
};
