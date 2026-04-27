import { FastifyReply, FastifyRequest } from 'fastify';
import { PaymentLinkValidator } from '../validators/payment-link/payment-link-validator';
import { PaymentLinkMapper } from '../mappers/payment-link-mapper';
import { CreatePaymentLinkRequest } from '../models/payment-link/create-payment-link-request';

export const PaymentLinkController = {
    async createPaymentLink(request: FastifyRequest, reply: FastifyReply): Promise<void> {
        const presentationRequest = CreatePaymentLinkRequest.fromApiRequest(request);

        PaymentLinkValidator.validate(presentationRequest);

        const requestDto = PaymentLinkMapper.toDto(presentationRequest);

        const responseDto = await request.services.paymentLink.createLink(
            request.clients.paymentLink,
            requestDto,
            request.log,
        );

        const presentationResponse = PaymentLinkMapper.fromDto(responseDto);

        reply.code(201).header('Content-Type', 'application/json').send(presentationResponse);
    },
};
