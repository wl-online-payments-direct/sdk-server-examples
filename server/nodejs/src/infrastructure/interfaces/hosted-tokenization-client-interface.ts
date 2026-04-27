import { FastifyBaseLogger } from 'fastify';
import { GetHostedTokenizationResponseDto } from '../../business/dtos/hosted-tokenization/get-hosted-tokenization-response-dto';

export interface IHostedTokenizationClient {
    createHostedTokenization(logger: FastifyBaseLogger): Promise<GetHostedTokenizationResponseDto>;
}