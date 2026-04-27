import { FastifyRequest } from 'fastify';
import { AddressDto, fromJson } from '../../../business/dtos/common/address-dto';

export interface CreateHostedCheckoutRequest {
    amount?: number | null;
    currency?: string | null;
    language?: string | null;
    redirectUrl?: string | null;
    billingAddress?: AddressDto | null;
    shippingAddress?: AddressDto | null;
}

export const CreateHostedCheckoutRequest = {
    fromApiRequest(request: FastifyRequest): CreateHostedCheckoutRequest {
        const data = (request.body as any) || {};

        return {
            amount: data.amount,
            currency: data.currency,
            language: data.language,
            redirectUrl: data.redirectUrl,
            billingAddress: fromJson(data.billingAddress ?? {}),
            shippingAddress: fromJson(data.shippingAddress ?? {}),
        };
    },
};
