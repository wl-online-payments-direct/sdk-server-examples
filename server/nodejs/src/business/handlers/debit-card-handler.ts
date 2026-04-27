import { PaymentMethodType } from '../domain/enums/payments/payment-method-type';
import { FastifyBaseLogger } from 'fastify';
import { CreatePaymentRequestDto } from '../dtos/payment/create-payment/create-payment-request-dto';
import { PaymentMethodHandlerInterface } from '../interfaces/payment-method-handler-interface';
import { IPaymentsClient } from '../../infrastructure/interfaces/payments-client-interface';
import { IMandateClient } from '../../infrastructure/interfaces/mandate-client-interface';
import { CreatePaymentResponseDto } from '../dtos/payment/create-payment/create-payment-response-dto';

export class DirectDebitHandler implements PaymentMethodHandlerInterface {
    constructor(
        private paymentsClient: IPaymentsClient,
        private mandateClient: IMandateClient,
        private logger: FastifyBaseLogger,
    ) {}

    getSupportedMethod(): PaymentMethodType {
        return PaymentMethodType.DIRECT_DEBIT;
    }

    async handle(requestDto: CreatePaymentRequestDto): Promise<CreatePaymentResponseDto> {
        let existingMandate = null;

        if (requestDto.mandate?.mandateReference != null && requestDto.mandate.mandateReference !== '') {
            existingMandate = await this.mandateClient.getMandate(requestDto.mandate.mandateReference, this.logger);
        }

        if (!existingMandate?.mandateReference) {
            const createMandateResponse = await this.mandateClient.createMandate(requestDto, this.logger);

            if (!!requestDto.mandate) {
                requestDto.mandate.mandateReference = createMandateResponse.mandateReference;
            }
        } else if (!!requestDto.mandate) {
            requestDto.mandate.mandateReference = existingMandate?.mandateReference ?? undefined;
        }

        return await this.paymentsClient.createPayment(requestDto, this.logger);
    }
}
