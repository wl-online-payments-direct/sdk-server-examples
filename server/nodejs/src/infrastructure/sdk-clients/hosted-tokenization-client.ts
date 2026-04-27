import { FastifyBaseLogger } from 'fastify';
import { Domain } from 'onlinepayments-sdk-nodejs';
import { IHostedTokenizationClient } from '../interfaces/hosted-tokenization-client-interface';
import { GetHostedTokenizationResponseDto } from '../../business/dtos/hosted-tokenization/get-hosted-tokenization-response-dto';
import { HostedTokenizationMapper } from '../mappers/hosted-tokenization-mapper';
import { createMerchantClient } from '../../configuration/merchant-client-configuration/merchant-client-config';
import { ErrorMapper } from '../mappers/error-mapper';

export const hostedTokenizationClient = (
    merchantClient: ReturnType<typeof createMerchantClient>,
): IHostedTokenizationClient => ({
    async createHostedTokenization(logger: FastifyBaseLogger): Promise<GetHostedTokenizationResponseDto> {
        const client = merchantClient.getClient(logger);
        const merchantId = merchantClient.getMerchantId(logger);
        const request: Domain.CreateHostedTokenizationRequest = {};

        logger.info('The generation of the hosted tokenization ID has started.');

        const response = await client.hostedTokenization.createHostedTokenization(merchantId, request);

        if (!response.isSuccess) {
            logger.error(`Failed hosted tokenization - Status: ${response.status}`);
            throw ErrorMapper.fromSdkError(response.body, response.status);
        }

        logger.info(
            `Generation of the hosted tokenization ID successfully completed - HostedTokenizationId: ${response.body.hostedTokenizationId}.`,
        );

        return HostedTokenizationMapper.fromSdkResponse(response.body);
    },
});
