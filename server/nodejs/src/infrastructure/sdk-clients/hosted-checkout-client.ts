import { FastifyBaseLogger } from 'fastify';
import { IHostedCheckoutClient } from '../interfaces/hosted-checkout-client-interface';
import { CreateHostedCheckoutRequestDto } from '../../business/dtos/hosted-checkout/create-hosted-checkout-request-dto';
import { CreateHostedCheckoutResponseDto } from '../../business/dtos/hosted-checkout/create-hosted-checkout-response-dto';
import { GetPaymentByHostedCheckoutResponseDto } from '../../business/dtos/hosted-checkout/get-payment-by-hosted-checkout-response-dto';
import { HostedCheckoutMapper } from '../mappers/hosted-checkout-mapper';
import { createMerchantClient } from '../../configuration/merchant-client-configuration/merchant-client-config';
import { ErrorMapper } from '../mappers/error-mapper';

export const hostedCheckoutClient = (
    merchantClient: ReturnType<typeof createMerchantClient>,
): IHostedCheckoutClient => ({
    async createHostedCheckout(
        request: CreateHostedCheckoutRequestDto,
        logger: FastifyBaseLogger,
    ): Promise<CreateHostedCheckoutResponseDto> {
        const client = merchantClient.getClient(logger);
        const merchantId = merchantClient.getMerchantId(logger);
        const sdkRequest = HostedCheckoutMapper.toSdkRequest(request);

        logger.info(
            `Creating hosted checkout request for payment - Amount: ${sdkRequest.order?.amountOfMoney?.amount}; Currency: ${sdkRequest.order?.amountOfMoney?.currencyCode}.`,
        );

        const response = await client.hostedCheckout.createHostedCheckout(merchantId, sdkRequest);

        if (!response.isSuccess) {
            logger.error(`Failed hosted checkout - Status: ${response.status}`);
            throw ErrorMapper.fromSdkError(response.body, response.status);
        }

        logger.info(`Successful hosted checkout - Redirect url: ${response.body.redirectUrl}.`);

        return HostedCheckoutMapper.fromSdkResponse(response.body);
    },

    async getPaymentByHostedCheckoutId(
        id: string,
        logger: FastifyBaseLogger,
    ): Promise<GetPaymentByHostedCheckoutResponseDto | null> {
        const client = merchantClient.getClient(logger);
        const merchantId = merchantClient.getMerchantId(logger);

        logger.info(`Get details for payment with hosted checkout id: ${id}.`);

        const response = await client.hostedCheckout.getHostedCheckout(merchantId, id);

        if (!response.isSuccess) {
            logger.error(`Failed to get hosted checkout - Status: ${response.status}`);
            throw ErrorMapper.fromSdkError(response.body, response.status);
        }

        logger.info('Payment details retrieved successfully.');

        return HostedCheckoutMapper.fromGetHostedCheckoutSdkResponse(response.body);
    },
});
