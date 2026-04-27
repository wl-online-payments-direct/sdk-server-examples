import { FastifyBaseLogger } from 'fastify';
import { GetIinDetailsRequestDto } from '../../business/dtos/services/get-iin-details-request-dto';
import { GetIinDetailsResponseDto } from '../../business/dtos/services/get-iin-details-response-dto';
import { IServiceClient } from '../interfaces/service-interface';
import { ServiceMapper } from '../mappers/service-mapper';
import { createMerchantClient } from '../../configuration/merchant-client-configuration/merchant-client-config';
import { ErrorMapper } from '../mappers/error-mapper';

export const serviceClient = (merchantClient: ReturnType<typeof createMerchantClient>): IServiceClient => ({
    async getIinDetails(
        request: GetIinDetailsRequestDto,
        logger: FastifyBaseLogger,
    ): Promise<GetIinDetailsResponseDto | null> {
        const sdkRequest = ServiceMapper.toSdkIinDetailsRequest(request);
        const client = merchantClient.getClient(logger);
        const merchantId = merchantClient.getMerchantId(logger);

        logger.info(`Fetching the payment product id for card number: ${request.bin}`);

        const response = await client.services.getIINDetails(merchantId, sdkRequest);

        if (!response.isSuccess) {
            logger.error(`Failed to get IIN details - Status: ${response.status}`);
            throw ErrorMapper.fromSdkError(response.body, response.status);
        }

        if (!response.body.paymentProductId) {
            logger.info(`No valid payment product id found for card number: ${request.bin}`);
            throw ErrorMapper.fromSdkError(
                null,
                400,
                `No valid payment product id found for card number: ${request.bin}`,
            );
        }

        logger.info(
            `Payment product id: ${ServiceMapper.fromSdkIinDetailsResponse(response.body).paymentProductId} returned for card number: ${request.bin}`,
        );

        return ServiceMapper.fromSdkIinDetailsResponse(response.body);
    },
});
