import { FastifyReply, FastifyRequest } from 'fastify';
import { HostedCheckoutValidator } from '../validators/hosted-checkout/hosted-checkout-validator';
import { CreateHostedCheckoutRequest } from '../models/hosted-checkout/create-hosted-checkout-request';
import { HostedCheckoutMapper } from '../mappers/hosted-checkout-mapper';

export const HostedCheckoutController = {
    async createHostedCheckoutSession(request: FastifyRequest, reply: FastifyReply): Promise<void> {
        const presentationRequest = CreateHostedCheckoutRequest.fromApiRequest(request);

        HostedCheckoutValidator.validate(presentationRequest);

        const requestDto = HostedCheckoutMapper.toDto(presentationRequest);

        const responseDto = await request.services.hostedCheckout.createHostedCheckout(
            request.clients.hostedCheckout,
            requestDto,
            request.log,
        );

        const presentationResponse = HostedCheckoutMapper.fromDto(responseDto, requestDto);

        reply.code(201).header('Content-Type', 'application/json').send(presentationResponse);
    },

    async getPaymentByHostedCheckoutId(request: FastifyRequest, reply: FastifyReply): Promise<void> {
        const { id } = request.params as { id: string };

        const responseDto = await request.services.hostedCheckout.getPaymentByHostedCheckoutId(
            request.clients.hostedCheckout,
            id,
            request.log,
        );

        const presentationResponse = HostedCheckoutMapper.fromPaymentDto(responseDto);

        reply.code(200).header('Content-Type', 'application/json').send(presentationResponse);
    },
};
