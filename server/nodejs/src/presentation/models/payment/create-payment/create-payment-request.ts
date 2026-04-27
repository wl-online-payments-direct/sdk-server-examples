import { FastifyRequest } from 'fastify';
import { AddressDto, fromJson as addressFromJson } from '../../../../business/dtos/common/address-dto';
import { Card } from '../../../../business/domain/payments/card';
import { Mandate } from '../../../../business/domain/payments/mandate';
import { RecurrenceType } from '../../../../business/domain/enums/payments/recurrence-type';
import { SignatureType } from '../../../../business/domain/enums/payments/signature-type';

export interface CreatePaymentRequest {
    amount?: number | null;
    currency?: string | null;
    method?: string | null;
    hostedTokenizationId?: string | null;
    shippingAddress?: AddressDto | null;
    billingAddress?: AddressDto | null;
    card?: Card | null;
    mandate?: Mandate | null;
}

export const CreatePaymentRequest = {
    fromApiRequest(request: FastifyRequest): CreatePaymentRequest {
        const data = (request.body as any) || {};

        return {
            amount: data.amount,
            currency: data.currency,
            method: data.method,
            hostedTokenizationId: data.hostedTokenizationId,
            shippingAddress: data.shippingAddress ? addressFromJson(data.shippingAddress) : undefined,
            billingAddress: data.billingAddress ? addressFromJson(data.billingAddress) : undefined,
            card: data.card
                ? {
                      number: data.card.number,
                      holderName: data.card.holderName,
                      verificationCode: data.card.verificationCode,
                      expiryMonth: data.card.expiryMonth,
                      expiryYear: data.card.expiryYear,
                  }
                : undefined,
            mandate: data.mandate
                ? {
                      iban: data.mandate.iban,
                      customerReference: data.mandate.customerReference,
                      mandateReference: data.mandate.mandateReference,
                      recurrenceType: data.mandate.recurrenceType
                          ? (data.mandate.recurrenceType as RecurrenceType)
                          : undefined,
                      signatureType: data.mandate.signatureType
                          ? (data.mandate.signatureType as SignatureType)
                          : undefined,
                      returnUrl: data.mandate.returnUrl,
                      address: data.mandate.address ? addressFromJson(data.mandate.address) : undefined,
                  }
                : undefined,
        };
    },
};
