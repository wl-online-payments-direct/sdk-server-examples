import { FastifyBaseLogger } from 'fastify';
import { GetHostedTokenizationResponseDto } from '../dtos/hosted-tokenization/get-hosted-tokenization-response-dto';
import { IHostedTokenizationClient } from '../../infrastructure/interfaces/hosted-tokenization-client-interface';

export interface IHostedTokenizationService {
    createHostedTokenization(
        client: IHostedTokenizationClient,
        logger: FastifyBaseLogger,
    ): Promise<GetHostedTokenizationResponseDto>;
}
