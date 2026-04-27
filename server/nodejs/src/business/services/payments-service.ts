import { FastifyBaseLogger } from 'fastify';
import { CreatePaymentRequestDto } from '../dtos/payment/create-payment/create-payment-request-dto';
import { CreatePaymentResponseDto } from '../dtos/payment/create-payment/create-payment-response-dto';
import { PaymentMethodHandlerInterface } from '../interfaces/payment-method-handler-interface';
import { CreditCardHandler } from '../handlers/credit-card-handler';
import { TokenHandler } from '../handlers/token-handler';
import { ValidationError } from '../errors/validation-error';
import { DirectDebitHandler } from '../handlers/debit-card-handler';
import { AdditionalPaymentActionRequestDto } from '../dtos/payment/additional-payment-action/additional-payment-action-request-dto';
import { AdditionalPaymentActionResponseDto } from '../dtos/payment/additional-payment-action/additional-payment-action-response-dto';
import { IPaymentsClient } from '../../infrastructure/interfaces/payments-client-interface';
import { IMandateClient } from '../../infrastructure/interfaces/mandate-client-interface';
import { IPaymentService } from '../interfaces/payments-service-interface';
import { GetPaymentDetailsResponseDto } from '../dtos/payment/get-payment-details/get-payment-details-response-dto';
import { IServiceClient } from '../../infrastructure/interfaces/service-interface';

type Clients = {
    payments: IPaymentsClient;
    mandate: IMandateClient;
    service: IServiceClient;
};

export const PaymentService: IPaymentService = {
    createPayment: async (
        clients: Clients,
        requestDto: CreatePaymentRequestDto,
        logger: FastifyBaseLogger,
    ): Promise<CreatePaymentResponseDto> => {
        const handlers: PaymentMethodHandlerInterface[] = [
            new CreditCardHandler(clients.payments, clients.service, logger),
            new TokenHandler(clients.payments, logger),
            new DirectDebitHandler(clients.payments, clients.mandate, logger),
        ];

        const handler = handlers.find((h) => h.getSupportedMethod() === requestDto.method);

        if (!handler) {
            throw new ValidationError(['Unsupported payment method.']);
        }

        return handler.handle(requestDto);
    },

    capturesPayment: async (
        clients: Clients,
        requestDto: AdditionalPaymentActionRequestDto,
        paymentId: string,
        logger: FastifyBaseLogger,
    ): Promise<AdditionalPaymentActionResponseDto> => {
        return clients.payments.capturesPayment(requestDto, paymentId, logger);
    },

    cancelsPayment: async (
        clients: Clients,
        requestDto: AdditionalPaymentActionRequestDto,
        paymentId: string,
        logger: FastifyBaseLogger,
    ): Promise<AdditionalPaymentActionResponseDto> => {
        return clients.payments.cancelsPayment(requestDto, paymentId, logger);
    },

    refundsPayment: async (
        clients: Clients,
        requestDto: AdditionalPaymentActionRequestDto,
        paymentId: string,
        logger: FastifyBaseLogger,
    ): Promise<AdditionalPaymentActionResponseDto> => {
        return clients.payments.refundPayment(requestDto, paymentId, logger);
    },

    getPaymentDetailsById: async (
        client: IPaymentsClient,
        paymentId: string,
        logger: FastifyBaseLogger,
    ): Promise<GetPaymentDetailsResponseDto> => {
        return client.getPaymentDetailsById(paymentId, logger);
    },
};
