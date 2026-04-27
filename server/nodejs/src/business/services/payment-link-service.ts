import { FastifyBaseLogger } from 'fastify';
import { CreatePaymentLinkResponseDto } from '../dtos/payment-link/create-payment-link-response-dto';
import { CreatePaymentLinkRequestDto } from '../dtos/payment-link/create-payment-link-request-dto';
import { IPaymentLinkClient } from '../../infrastructure/interfaces/payment-link-client-interface';
import { IPaymentLinkService } from '../interfaces/payment-link-service-interface';

export const PaymentLinkService: IPaymentLinkService = {
    async createLink(
        client: IPaymentLinkClient,
        requestDto: CreatePaymentLinkRequestDto,
        logger: FastifyBaseLogger,
    ): Promise<CreatePaymentLinkResponseDto> {
        return await client.createPaymentLink(requestDto, logger);
    },
};
