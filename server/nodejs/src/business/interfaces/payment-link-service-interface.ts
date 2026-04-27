import { FastifyBaseLogger } from 'fastify';
import { CreatePaymentLinkRequestDto } from '../dtos/payment-link/create-payment-link-request-dto';
import { CreatePaymentLinkResponseDto } from '../dtos/payment-link/create-payment-link-response-dto';
import { IPaymentLinkClient } from '../../infrastructure/interfaces/payment-link-client-interface';

export interface IPaymentLinkService {
    createLink(
        client: IPaymentLinkClient,
        requestDto: CreatePaymentLinkRequestDto,
        logger: FastifyBaseLogger,
    ): Promise<CreatePaymentLinkResponseDto>;
}
