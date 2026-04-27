import { FastifyRequest } from 'fastify';

export interface CreatePaymentLinkRequest {
    amount?: number | null;
    currency?: string | null;
    validFor?: string | null;
    action?: string | null;
    description?: string | null;
}

export const CreatePaymentLinkRequest = {
    fromApiRequest(request: FastifyRequest): CreatePaymentLinkRequest {
        const data = (request.body as any) || {};

        let validFor: string | null = null;

        if (data.validFor !== undefined && data.validFor !== null) {
            validFor = typeof data.validFor === 'number' ? String(data.validFor) : data.validFor;
        }

        return {
            amount: data.amount,
            currency: data.currency,
            validFor: validFor,
            action: data.action,
            description: data.description,
        };
    },
};
