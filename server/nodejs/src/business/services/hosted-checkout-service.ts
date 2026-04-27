import { CreateHostedCheckoutRequestDto } from '../dtos/hosted-checkout/create-hosted-checkout-request-dto';
import { CreateHostedCheckoutResponseDto } from '../dtos/hosted-checkout/create-hosted-checkout-response-dto';
import { FastifyBaseLogger } from 'fastify';
import { IHostedCheckoutClient } from '../../infrastructure/interfaces/hosted-checkout-client-interface';
import { IHostedCheckoutService } from '../interfaces/hosted-checkout-service-interface';
import { GetPaymentByHostedCheckoutResponseDto } from '../dtos/hosted-checkout/get-payment-by-hosted-checkout-response-dto';

export const HostedCheckoutService: IHostedCheckoutService = {
    async createHostedCheckout(
        client: IHostedCheckoutClient,
        requestDto: CreateHostedCheckoutRequestDto,
        logger: FastifyBaseLogger,
    ): Promise<CreateHostedCheckoutResponseDto> {
        return await client.createHostedCheckout(requestDto, logger);
    },

    async getPaymentByHostedCheckoutId(
        client: IHostedCheckoutClient,
        hostedCheckoutId: string,
        logger: FastifyBaseLogger,
    ): Promise<GetPaymentByHostedCheckoutResponseDto | null> {
        return await client.getPaymentByHostedCheckoutId(hostedCheckoutId, logger);
    },
};
