import { FastifyReply, FastifyRequest } from 'fastify';
import { PaymentValidator } from '../validators/payment/payment-validator';
import { CreatePaymentRequest } from '../models/payment/create-payment/create-payment-request';
import { PaymentMapper } from '../mappers/payments-mapper';
import { AdditionalPaymentActionMapper } from '../mappers/additional-payment-action-mapper';
import { PaymentDetailsMapper } from '../mappers/payment-details-mapper';
import {
    AdditionalPaymentActionRequest
} from '../models/payment/additional-payment-action/additional-payment-action-request';
import {
    AdditionalPaymentActionValidator
} from '../validators/payment/additional-payment-actions/additional-payment-actions';

export const PaymentsController = {
    async createPayment(request: FastifyRequest, reply: FastifyReply): Promise<void> {
        const presentationRequest = CreatePaymentRequest.fromApiRequest(request);

        PaymentValidator.validate(presentationRequest);

        const requestDto = PaymentMapper.toDto(presentationRequest);

        const clientsObject = {
            payments: request.clients.payments,
            mandate: request.clients.mandate,
            service: request.clients.service,
        };

        const responseDto = await request.services.payment.createPayment(clientsObject, requestDto, request.log);

        const presentationResponse = PaymentMapper.fromDto(responseDto);

        reply.code(201).header('Content-Type', 'application/json').send(presentationResponse);
    },

    async capturesPayment(
        request: FastifyRequest<{
            Params: { id: string };
        }>,
        reply: FastifyReply,
    ): Promise<void> {
        const { id } = request.params;
        const presentationRequest = AdditionalPaymentActionRequest.fromApiRequest(request);

        AdditionalPaymentActionValidator.validate(presentationRequest);

        const requestDto = AdditionalPaymentActionMapper.toDto(presentationRequest);

        const responseDto = await request.services.payment.capturesPayment(
            {
                payments: request.clients.payments,
                mandate: request.clients.mandate,
            },
            requestDto,
            id,
            request.log,
        );

        const presentationResponse = AdditionalPaymentActionMapper.fromDto(responseDto);

        reply.code(200).header('Content-Type', 'application/json').send(presentationResponse);
    },

    async cancelsPayment(
        request: FastifyRequest<{
            Params: { id: string };
        }>,
        reply: FastifyReply,
    ): Promise<void> {
        const { id } = request.params;
        const presentationRequest = AdditionalPaymentActionRequest.fromApiRequest(request);

        AdditionalPaymentActionValidator.validate(presentationRequest);

        const requestDto = AdditionalPaymentActionMapper.toDto(presentationRequest);

        const responseDto = await request.services.payment.cancelsPayment(
            {
                payments: request.clients.payments,
                mandate: request.clients.mandate,
            },
            requestDto,
            id,
            request.log,
        );

        const presentationResponse = AdditionalPaymentActionMapper.fromDto(responseDto);

        reply.code(200).header('Content-Type', 'application/json').send(presentationResponse);
    },

    async refundsPayment(
        request: FastifyRequest<{
            Params: { id: string };
        }>,
        reply: FastifyReply,
    ): Promise<void> {
        const { id } = request.params;
        const presentationRequest = AdditionalPaymentActionRequest.fromApiRequest(request);

        AdditionalPaymentActionValidator.validate(presentationRequest);

        const requestDto = AdditionalPaymentActionMapper.toDto(presentationRequest);

        const responseDto = await request.services.payment.refundsPayment(
            {
                payments: request.clients.payments,
                mandate: request.clients.mandate,
            },
            requestDto,
            id,
            request.log,
        );

        const presentationResponse = AdditionalPaymentActionMapper.fromDto(responseDto);

        reply.code(200).header('Content-Type', 'application/json').send(presentationResponse);
    },

    async getPaymentDetailsById(
        request: FastifyRequest<{
            Params: { id: string };
        }>,
        reply: FastifyReply,
    ): Promise<void> {
        const { id } = request.params;

        const responseDto = await request.services.payment.getPaymentDetailsById(
            request.clients.payments,
            id,
            request.log,
        );

        const presentationResponse = PaymentDetailsMapper.fromDto(responseDto);

        reply.code(200).header('Content-Type', 'application/json').send(presentationResponse);
    },
};
