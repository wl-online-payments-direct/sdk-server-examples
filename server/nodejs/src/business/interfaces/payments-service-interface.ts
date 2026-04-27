import { FastifyBaseLogger } from 'fastify';
import { CreatePaymentRequestDto } from '../dtos/payment/create-payment/create-payment-request-dto';
import { CreatePaymentResponseDto } from '../dtos/payment/create-payment/create-payment-response-dto';
import { AdditionalPaymentActionRequestDto } from '../dtos/payment/additional-payment-action/additional-payment-action-request-dto';
import { AdditionalPaymentActionResponseDto } from '../dtos/payment/additional-payment-action/additional-payment-action-response-dto';
import { IPaymentsClient } from '../../infrastructure/interfaces/payments-client-interface';
import { IMandateClient } from '../../infrastructure/interfaces/mandate-client-interface';
import { GetPaymentDetailsResponseDto } from '../dtos/payment/get-payment-details/get-payment-details-response-dto';

type Clients = {
    payments: IPaymentsClient;
    mandate: IMandateClient;
};

export interface IPaymentService {
    createPayment(
        clients: Clients,
        requestDto: CreatePaymentRequestDto,
        logger: FastifyBaseLogger,
    ): Promise<CreatePaymentResponseDto>;

    capturesPayment(
        clients: Clients,
        requestDto: AdditionalPaymentActionRequestDto,
        paymentId: string,
        logger: FastifyBaseLogger,
    ): Promise<AdditionalPaymentActionResponseDto>;

    cancelsPayment(
        clients: Clients,
        requestDto: AdditionalPaymentActionRequestDto,
        paymentId: string,
        logger: FastifyBaseLogger,
    ): Promise<AdditionalPaymentActionResponseDto>;

    refundsPayment(
        clients: Clients,
        requestDto: AdditionalPaymentActionRequestDto,
        paymentId: string,
        logger: FastifyBaseLogger,
    ): Promise<AdditionalPaymentActionResponseDto>;

    getPaymentDetailsById(
        client: IPaymentsClient,
        paymentId: string,
        logger: FastifyBaseLogger,
    ): Promise<GetPaymentDetailsResponseDto>;
}
