import { PaymentMethodHandlerInterface } from '../interfaces/payment-method-handler-interface';
import { FastifyBaseLogger } from 'fastify';
import { PaymentMethodType } from '../domain/enums/payments/payment-method-type';
import { CreatePaymentRequestDto } from '../dtos/payment/create-payment/create-payment-request-dto';
import { IPaymentsClient } from '../../infrastructure/interfaces/payments-client-interface';
import { CreatePaymentResponseDto } from '../dtos/payment/create-payment/create-payment-response-dto';

export class TokenHandler implements PaymentMethodHandlerInterface {
    constructor(
        private paymentsClient: IPaymentsClient,
        private logger: FastifyBaseLogger,
    ) {}

    getSupportedMethod(): PaymentMethodType {
        return PaymentMethodType.TOKEN;
    }

    async handle(requestDto: CreatePaymentRequestDto): Promise<CreatePaymentResponseDto> {
        return await this.paymentsClient.createPayment(requestDto, this.logger);
    }
}
