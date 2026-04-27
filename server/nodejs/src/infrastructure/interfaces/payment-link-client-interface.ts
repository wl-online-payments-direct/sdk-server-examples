import { FastifyBaseLogger } from 'fastify';
import { CreatePaymentLinkRequestDto } from '../../business/dtos/payment-link/create-payment-link-request-dto';
import { CreatePaymentLinkResponseDto } from '../../business/dtos/payment-link/create-payment-link-response-dto';

export interface IPaymentLinkClient {
    createPaymentLink(
        request: CreatePaymentLinkRequestDto,
        logger: FastifyBaseLogger,
    ): Promise<CreatePaymentLinkResponseDto>;
}
