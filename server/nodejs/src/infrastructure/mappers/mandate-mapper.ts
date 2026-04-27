import { Domain } from 'onlinepayments-sdk-nodejs';
import { Mandate } from '../../business/domain/payments/mandate';
import { RecurrenceType } from '../../business/domain/enums/payments/recurrence-type';
import { CreatePaymentRequestDto } from '../../business/dtos/payment/create-payment/create-payment-request-dto';
import { CountryUtil } from '../../business/utils/models/country-util';

export const MandateMapper = {
    toSdkRequest(requestDto?: CreatePaymentRequestDto | null): Domain.CreateMandateRequest {
        return {
            customer: {
                bankAccountIban: {
                    iban: requestDto?.mandate?.iban,
                },
                mandateAddress: {
                    countryCode: !!requestDto?.mandate?.address?.country
                        ? CountryUtil.toIsoAlpha2(requestDto.mandate.address.country)
                        : undefined,
                    city: requestDto?.mandate?.address?.city,
                    street: requestDto?.mandate?.address?.street,
                    zip: requestDto?.mandate?.address?.zip,
                },
                personalInformation: {
                    name: {
                        firstName: requestDto?.mandate?.address?.firstName,
                        surname: requestDto?.mandate?.address?.lastName,
                    },
                },
            },
            customerReference: requestDto?.mandate?.customerReference,
            recurrenceType: requestDto?.mandate?.recurrenceType?.toString() ?? undefined,
            returnUrl: requestDto?.mandate?.returnUrl,
            signatureType: requestDto?.mandate?.signatureType?.toString() ?? undefined,
        };
    },

    fromSdkResponse(mandate?: Domain.MandateResponse | null): Mandate {
        const recurrenceTypeString = mandate?.recurrenceType ?? null;
        const recurrenceType =
            !!recurrenceTypeString &&
            Object.values(RecurrenceType).includes(recurrenceTypeString.toUpperCase() as RecurrenceType)
                ? (recurrenceTypeString.toUpperCase() as RecurrenceType)
                : undefined;

        return {
            customerReference: mandate?.customerReference,
            iban: mandate?.customer?.bankAccountIban?.iban,
            recurrenceType: recurrenceType,
            mandateReference: mandate?.uniqueMandateReference,
            signatureType: undefined,
            returnUrl: undefined,
            address: {
                lastName: mandate?.customer?.personalInformation?.name?.surname,
                firstName: mandate?.customer?.personalInformation?.name?.firstName,
                city: mandate?.customer?.mandateAddress?.city,
                street: mandate?.customer?.mandateAddress?.street,
                zip: mandate?.customer?.mandateAddress?.zip,
                country: undefined,
            },
        };
    },
};
