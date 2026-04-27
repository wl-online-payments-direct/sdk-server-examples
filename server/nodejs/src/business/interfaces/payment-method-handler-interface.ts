import { PaymentMethodType } from '../domain/enums/payments/payment-method-type';
import { CreatePaymentRequestDto } from '../dtos/payment/create-payment/create-payment-request-dto';
import { CreatePaymentResponseDto } from '../dtos/payment/create-payment/create-payment-response-dto';

export interface PaymentMethodHandlerInterface {
    getSupportedMethod(): PaymentMethodType;
    handle(requestDto: CreatePaymentRequestDto): Promise<CreatePaymentResponseDto>;
}
