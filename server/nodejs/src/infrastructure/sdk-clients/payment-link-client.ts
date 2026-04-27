import { FastifyBaseLogger } from 'fastify';
import { IPaymentLinkClient } from '../interfaces/payment-link-client-interface';
import { CreatePaymentLinkRequestDto } from '../../business/dtos/payment-link/create-payment-link-request-dto';
import { CreatePaymentLinkResponseDto } from '../../business/dtos/payment-link/create-payment-link-response-dto';
import { PaymentLinkMapper } from '../mappers/payment-link-mapper';
import { createMerchantClient } from '../../configuration/merchant-client-configuration/merchant-client-config';
import { ErrorMapper } from '../mappers/error-mapper';

export const paymentLinkClient = (merchantClient: ReturnType<typeof createMerchantClient>): IPaymentLinkClient => ({
    async createPaymentLink(
        request: CreatePaymentLinkRequestDto,
        logger: FastifyBaseLogger,
    ): Promise<CreatePaymentLinkResponseDto> {
        const client = merchantClient.getClient(logger);
        const merchantId = merchantClient.getMerchantId(logger);
        const sdkRequest = PaymentLinkMapper.toSdkResponse(request);

        logger.info(
            `Creating payment link request for payment - Amount: ${sdkRequest.order?.amountOfMoney?.amount}; Currency: ${sdkRequest.order?.amountOfMoney?.currencyCode}.`,
        );

        const response = await client.paymentLinks.createPaymentLink(merchantId, sdkRequest);

        if (!response.isSuccess) {
            logger.error(`Failed payment link - Status: ${response.status}`);
            throw ErrorMapper.fromSdkError(response.body, response.status);
        }

        logger.info(`Successful payment link - Redirect url: ${response.body.redirectionUrl}.`);

        return PaymentLinkMapper.fromSdkResponse(response.body);
    },
});
