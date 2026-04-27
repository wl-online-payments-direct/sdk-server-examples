import { FastifyBaseLogger } from 'fastify';
import { CreateHostedCheckoutResponseDto } from '../../business/dtos/hosted-checkout/create-hosted-checkout-response-dto';
import { CreateHostedCheckoutRequestDto } from '../../business/dtos/hosted-checkout/create-hosted-checkout-request-dto';
import { GetPaymentByHostedCheckoutResponseDto } from '../../business/dtos/hosted-checkout/get-payment-by-hosted-checkout-response-dto';

export interface IHostedCheckoutClient {
    createHostedCheckout(
        request: CreateHostedCheckoutRequestDto,
        logger: FastifyBaseLogger,
    ): Promise<CreateHostedCheckoutResponseDto>;

    getPaymentByHostedCheckoutId(
        hostedCheckoutId: string,
        logger: FastifyBaseLogger,
    ): Promise<GetPaymentByHostedCheckoutResponseDto | null>;
}
