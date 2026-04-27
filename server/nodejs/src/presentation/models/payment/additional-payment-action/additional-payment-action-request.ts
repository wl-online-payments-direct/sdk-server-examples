import { FastifyRequest } from 'fastify';
import { Currency } from '../../../../business/domain/common/enums/currency';

export interface AdditionalPaymentActionRequest {
    amount?: number;
    currency?: Currency;
    isFinal?: boolean;
}

export const AdditionalPaymentActionRequest = {
    fromApiRequest(request: FastifyRequest): AdditionalPaymentActionRequest {
        const data = (request.body as any) || {};

        return {
            amount: data.amount,
            currency: data.currency,
            isFinal: data.isFinal,
        };
    },
};
