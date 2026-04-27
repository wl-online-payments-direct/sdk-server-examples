import { FastifyBaseLogger } from 'fastify';
import { CreatePaymentResponseDto } from '../../business/dtos/payment/create-payment/create-payment-response-dto';
import { CreatePaymentRequestDto } from '../../business/dtos/payment/create-payment/create-payment-request-dto';
import { GetPaymentDetailsResponseDto } from '../../business/dtos/payment/get-payment-details/get-payment-details-response-dto';
import { AdditionalPaymentActionResponseDto } from '../../business/dtos/payment/additional-payment-action/additional-payment-action-response-dto';
import { AdditionalPaymentActionRequestDto } from '../../business/dtos/payment/additional-payment-action/additional-payment-action-request-dto';

export interface IPaymentsClient {
    createPayment(request: CreatePaymentRequestDto, logger: FastifyBaseLogger): Promise<CreatePaymentResponseDto>;

    capturesPayment(
        request: AdditionalPaymentActionRequestDto,
        paymentId: string,
        logger: FastifyBaseLogger,
    ): Promise<AdditionalPaymentActionResponseDto>;

    cancelsPayment(
        request: AdditionalPaymentActionRequestDto,
        paymentId: string,
        logger: FastifyBaseLogger,
    ): Promise<AdditionalPaymentActionResponseDto>;

    refundPayment(
        request: AdditionalPaymentActionRequestDto,
        paymentId: string,
        logger: FastifyBaseLogger,
    ): Promise<AdditionalPaymentActionResponseDto>;

    getPaymentDetailsById(paymentId: string, logger: FastifyBaseLogger): Promise<GetPaymentDetailsResponseDto>;
}
