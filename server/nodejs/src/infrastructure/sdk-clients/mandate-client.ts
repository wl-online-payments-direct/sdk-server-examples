import { FastifyBaseLogger } from 'fastify';
import { IMandateClient } from '../interfaces/mandate-client-interface';
import { CreatePaymentRequestDto } from '../../business/dtos/payment/create-payment/create-payment-request-dto';
import { Mandate } from '../../business/domain/payments/mandate';
import { MandateMapper } from '../mappers/mandate-mapper';
import { createMerchantClient } from '../../configuration/merchant-client-configuration/merchant-client-config';
import { ErrorMapper } from '../mappers/error-mapper';

export const mandateClient = (merchantClient: ReturnType<typeof createMerchantClient>): IMandateClient => ({
    async createMandate(request: CreatePaymentRequestDto, logger: FastifyBaseLogger): Promise<Mandate> {
        const client = merchantClient.getClient(logger);
        const merchantId = merchantClient.getMerchantId(logger);
        const sdkRequest = MandateMapper.toSdkRequest(request);

        logger.info('Creating mandate start.');

        const response = await client.mandates.createMandate(merchantId, sdkRequest);

        if (!response.isSuccess) {
            logger.error(
                `Failed to create mandate - Status: ${response.status}, Error: ${JSON.stringify(response.body)}`,
            );
            throw ErrorMapper.fromSdkError(response.body, response.status);
        }

        logger.info(
            `Successful mandate with unique mandate reference: ${response.body?.mandate?.uniqueMandateReference}.`,
        );

        return MandateMapper.fromSdkResponse(response.body.mandate);
    },

    async getMandate(existingUniqueMandateReference: string, logger: FastifyBaseLogger): Promise<Mandate> {
        const client = merchantClient.getClient(logger);
        const merchantId = merchantClient.getMerchantId(logger);

        logger.info('Get mandate request.');

        const response = await client.mandates.getMandate(merchantId, existingUniqueMandateReference);

        if (!response.isSuccess) {
            logger.error(`Failed to get mandate - Status: ${response.status}`);
            throw ErrorMapper.fromSdkError(
                null,
                400,
                `Mandate with reference: ${existingUniqueMandateReference} not found.`,
            );
        }

        logger.info('Mandate retrieved successfully.');

        return MandateMapper.fromSdkResponse(response.body.mandate);
    },
});
