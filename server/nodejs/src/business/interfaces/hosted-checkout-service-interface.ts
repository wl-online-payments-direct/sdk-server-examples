import { FastifyBaseLogger } from 'fastify';
import { CreateHostedCheckoutRequestDto } from '../dtos/hosted-checkout/create-hosted-checkout-request-dto';
import { CreateHostedCheckoutResponseDto } from '../dtos/hosted-checkout/create-hosted-checkout-response-dto';
import { IHostedCheckoutClient } from '../../infrastructure/interfaces/hosted-checkout-client-interface';
import { GetPaymentByHostedCheckoutResponseDto } from '../dtos/hosted-checkout/get-payment-by-hosted-checkout-response-dto';

export interface IHostedCheckoutService {
    createHostedCheckout(
        client: IHostedCheckoutClient,
        requestDto: CreateHostedCheckoutRequestDto,
        logger: FastifyBaseLogger,
    ): Promise<CreateHostedCheckoutResponseDto>;

    getPaymentByHostedCheckoutId(
        client: IHostedCheckoutClient,
        hostedCheckoutId: string,
        logger: FastifyBaseLogger,
    ): Promise<GetPaymentByHostedCheckoutResponseDto | null>;
}
