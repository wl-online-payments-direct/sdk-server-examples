import { Domain } from 'onlinepayments-sdk-nodejs';
import { PaymentMethodType } from '../../business/domain/enums/payments/payment-method-type';
import { Status } from '../../business/domain/enums/payments/status';
import { StatusCategory } from '../../business/domain/common/enums/status-category';
import { CreatePaymentRequestDto } from '../../business/dtos/payment/create-payment/create-payment-request-dto';
import { CreatePaymentResponseDto } from '../../business/dtos/payment/create-payment/create-payment-response-dto';
import { CountryUtil } from '../../business/utils/models/country-util';
import { CardUtil } from '../../business/utils/models/card-util';
import { DIRECT_DEBIT_PRODUCT_ID } from '../../constants';

export const PaymentMapper = {
    toSdkRequest(requestDto: CreatePaymentRequestDto): Domain.CreatePaymentRequest {
        const request: Domain.CreatePaymentRequest = {
            order: {
                amountOfMoney: {
                    amount: requestDto.amount,
                    currencyCode: !!requestDto.currency ? requestDto.currency.toString() : undefined,
                },
                customer: {
                    personalInformation: {
                        name: {
                            firstName: requestDto.billingAddress?.firstName ?? undefined,
                            surname: requestDto.billingAddress?.lastName ?? undefined,
                        },
                    },
                    billingAddress: {
                        city: requestDto.billingAddress?.city ?? undefined,
                        countryCode: !!requestDto.billingAddress?.country
                            ? CountryUtil.toIsoAlpha2(requestDto.billingAddress.country)
                            : undefined,
                        street: requestDto.billingAddress?.street ?? undefined,
                        zip: requestDto.billingAddress?.zip ?? undefined,
                    },
                },
                shipping: {
                    address: {
                        name: {
                            firstName: requestDto.shippingAddress?.firstName,
                            surname: requestDto.shippingAddress?.lastName,
                        },
                        city: requestDto.shippingAddress?.city,
                        countryCode: !!requestDto.shippingAddress?.country
                            ? CountryUtil.toIsoAlpha2(requestDto.shippingAddress.country)
                            : undefined,
                        street: requestDto.shippingAddress?.street,
                        zip: requestDto.shippingAddress?.zip,
                    },
                },
            },
        };

        switch (requestDto.method) {
            case PaymentMethodType.CREDIT_CARD:
                request.cardPaymentMethodSpecificInput = {
                    paymentProductId: requestDto.paymentProductId,
                    card: {
                        cardNumber: requestDto.card?.number ?? undefined,
                        cardholderName: requestDto.card?.holderName ?? undefined,
                        expiryDate: `${requestDto.card?.expiryMonth ?? ''}${CardUtil.getYearSuffix(requestDto.card?.expiryYear ?? null)}`,
                        cvv: requestDto.card?.verificationCode ?? undefined,
                    },
                    threeDSecure: {
                        skipAuthentication: true,
                    },
                };
                break;

            case PaymentMethodType.TOKEN:
                request.hostedTokenizationId = requestDto.hostedTokenizationId ?? undefined;
                request.cardPaymentMethodSpecificInput = {
                    threeDSecure: {
                        skipAuthentication: true,
                    },
                };
                break;

            case PaymentMethodType.DIRECT_DEBIT:
                request.sepaDirectDebitPaymentMethodSpecificInput = {
                    paymentProductId: DIRECT_DEBIT_PRODUCT_ID,
                    paymentProduct771SpecificInput: {
                        existingUniqueMandateReference: requestDto.mandate?.mandateReference ?? undefined,
                    },
                };
                break;
        }

        return request;
    },

    fromSdkResponse(response: Domain.CreatePaymentResponse | undefined): CreatePaymentResponseDto {
        let status: Status | undefined = undefined;
        const statusString = response?.payment?.status ?? undefined;

        if (!!statusString) {
            const upperStatus = statusString.toUpperCase();
            if (Object.values(Status).includes(upperStatus as Status)) {
                status = upperStatus as Status;
            }
        }

        let statusCategory: StatusCategory | undefined = undefined;
        const statusCategoryString = response?.payment?.statusOutput?.statusCategory;

        if (statusCategoryString) {
            const upperCategory = statusCategoryString.toUpperCase();
            if (Object.values(StatusCategory).includes(upperCategory as StatusCategory)) {
                statusCategory = upperCategory as StatusCategory;
            }
        }

        return {
            id: response?.payment?.id ?? undefined,
            status: status,
            statusOutput: {
                statusCode: response?.payment?.statusOutput?.statusCode ?? undefined,
                statusCategory: statusCategory,
            },
        };
    },
};
