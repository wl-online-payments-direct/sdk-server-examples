import { PaymentMethodType } from '../domain/enums/payments/payment-method-type';
import { FastifyBaseLogger } from 'fastify';
import { CreatePaymentRequestDto } from '../dtos/payment/create-payment/create-payment-request-dto';
import { PaymentMethodHandlerInterface } from '../interfaces/payment-method-handler-interface';
import { IPaymentsClient } from '../../infrastructure/interfaces/payments-client-interface';
import { CreatePaymentResponseDto } from '../dtos/payment/create-payment/create-payment-response-dto';
import { GetIinDetailsRequestDto } from '../dtos/services/get-iin-details-request-dto';
import { IServiceClient } from '../../infrastructure/interfaces/service-interface';

export class CreditCardHandler implements PaymentMethodHandlerInterface {
    constructor(
        private paymentsClient: IPaymentsClient,
        private serviceClient: IServiceClient,
        private logger: FastifyBaseLogger,
    ) {}

    getSupportedMethod(): PaymentMethodType {
        return PaymentMethodType.CREDIT_CARD;
    }

    async handle(requestDto: CreatePaymentRequestDto): Promise<CreatePaymentResponseDto> {
        if (requestDto.card?.number) {
            const iinDetailsRequest: GetIinDetailsRequestDto = {
                bin: requestDto.card.number,
            };

            const iinDetailsResponse = await this.serviceClient.getIinDetails(iinDetailsRequest, this.logger);

            if (iinDetailsResponse?.paymentProductId) {
                requestDto.paymentProductId = iinDetailsResponse.paymentProductId;
            }
        }

        return await this.paymentsClient.createPayment(requestDto, this.logger);
    }
}
