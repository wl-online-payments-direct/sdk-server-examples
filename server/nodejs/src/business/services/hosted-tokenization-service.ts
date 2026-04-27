import { FastifyBaseLogger } from 'fastify';
import { GetHostedTokenizationResponseDto } from '../dtos/hosted-tokenization/get-hosted-tokenization-response-dto';
import { IHostedTokenizationClient } from '../../infrastructure/interfaces/hosted-tokenization-client-interface';
import { IHostedTokenizationService } from '../interfaces/hosted-tokenization-service-interface';

export const HostedTokenizationService: IHostedTokenizationService = {
    async createHostedTokenization(
        client: IHostedTokenizationClient,
        logger: FastifyBaseLogger,
    ): Promise<GetHostedTokenizationResponseDto> {
        return await client.createHostedTokenization(logger);
    },
};
