import { FastifyReply, FastifyRequest } from 'fastify';
import { HostedTokenizationMapper } from '../mappers/hosted-tokenization-mapper';

export const HostedTokenizationController = {
    async getHostedTokenization(request: FastifyRequest, reply: FastifyReply): Promise<void> {
        const responseDto = await request.services.hostedTokenization.createHostedTokenization(
            request.clients.hostedTokenization,
            request.log,
        );

        const presentationResponse = HostedTokenizationMapper.fromDto(responseDto);

        reply.code(200).header('Content-Type', 'application/json').send(presentationResponse);
    },
};
