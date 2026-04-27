import { FastifyBaseLogger } from 'fastify';
import { CreatePaymentRequestDto } from '../../business/dtos/payment/create-payment/create-payment-request-dto';
import { Mandate } from '../../business/domain/payments/mandate';

export interface IMandateClient {
    createMandate(request: CreatePaymentRequestDto, logger: FastifyBaseLogger): Promise<Mandate>;

    getMandate(existingUniqueMandateReference: string, logger: FastifyBaseLogger): Promise<Mandate>;
}
