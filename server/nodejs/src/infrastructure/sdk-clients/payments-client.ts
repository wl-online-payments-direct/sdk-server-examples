import { FastifyBaseLogger } from 'fastify';
import { IPaymentsClient } from '../interfaces/payments-client-interface';
import { CreatePaymentResponseDto } from '../../business/dtos/payment/create-payment/create-payment-response-dto';
import { CreatePaymentRequestDto } from '../../business/dtos/payment/create-payment/create-payment-request-dto';
import { AdditionalPaymentActionResponseDto } from '../../business/dtos/payment/additional-payment-action/additional-payment-action-response-dto';
import { AdditionalPaymentActionRequestDto } from '../../business/dtos/payment/additional-payment-action/additional-payment-action-request-dto';
import { GetPaymentDetailsResponseDto } from '../../business/dtos/payment/get-payment-details/get-payment-details-response-dto';
import { AdditionalPaymentActionMapper } from '../mappers/additional-payment-mapper';
import { PaymentMapper } from '../mappers/payments-mapper';
import { PaymentDetailsMapper } from '../mappers/payment-details-mapper';
import { createMerchantClient } from '../../configuration/merchant-client-configuration/merchant-client-config';
import { ErrorMapper } from '../mappers/error-mapper';

export const paymentsClient = (merchantClient: ReturnType<typeof createMerchantClient>): IPaymentsClient => ({
    async createPayment(
        request: CreatePaymentRequestDto,
        logger: FastifyBaseLogger,
    ): Promise<CreatePaymentResponseDto> {
        const client = merchantClient.getClient(logger);
        const merchantId = merchantClient.getMerchantId(logger);
        const sdkRequest = PaymentMapper.toSdkRequest(request);

        logger.info(
            `Creating payment request for payment - Amount: ${sdkRequest.order?.amountOfMoney?.amount}; Currency: ${sdkRequest.order?.amountOfMoney?.currencyCode}.`,
        );

        const response = await client.payments.createPayment(merchantId, sdkRequest);

        if (!response.isSuccess) {
            logger.error(`Failed payment - Status: ${response.status}`);
            throw ErrorMapper.fromSdkError(response.body, response.status);
        }

        logger.info(`Successful payment with payment id: ${response.body.payment?.id}`);

        return PaymentMapper.fromSdkResponse(response.body);
    },

    async capturesPayment(
        request: AdditionalPaymentActionRequestDto,
        paymentId: string,
        logger: FastifyBaseLogger,
    ): Promise<AdditionalPaymentActionResponseDto> {
        const client = merchantClient.getClient(logger);
        const merchantId = merchantClient.getMerchantId(logger);
        const sdkRequest = AdditionalPaymentActionMapper.toSdkCaptureRequest(request);

        logger.info(`Capture for payment - Id: ${paymentId}, Amount: ${sdkRequest.amount}`);

        const response = await client.payments.capturePayment(merchantId, paymentId, sdkRequest);

        if (!response.isSuccess) {
            logger.error(`Failed capture for payment - Status: ${response.status}`);
            throw ErrorMapper.fromSdkError(response.body, response.status);
        }

        logger.info(`Successful capture for payment.`);

        return AdditionalPaymentActionMapper.fromSdkCaptureResponse(response.body);
    },

    async cancelsPayment(
        request: AdditionalPaymentActionRequestDto,
        paymentId: string,
        logger: FastifyBaseLogger,
    ): Promise<AdditionalPaymentActionResponseDto> {
        const client = merchantClient.getClient(logger);
        const merchantId = merchantClient.getMerchantId(logger);
        const sdkRequest = AdditionalPaymentActionMapper.toSdkCancelRequest(request);

        logger.info(`Cancel for payment - Id: ${paymentId}, Amount: ${sdkRequest.amountOfMoney?.amount}`);

        const response = await client.payments.cancelPayment(merchantId, paymentId, sdkRequest);

        if (!response.isSuccess) {
            logger.error(`Failed cancel for payment - Status: ${response.status}`);
            throw ErrorMapper.fromSdkError(response.body, response.status);
        }

        logger.info(`Successful cancel for payment.`);

        return AdditionalPaymentActionMapper.fromSdkCancelResponse(response.body);
    },

    async refundPayment(
        request: AdditionalPaymentActionRequestDto,
        paymentId: string,
        logger: FastifyBaseLogger,
    ): Promise<AdditionalPaymentActionResponseDto> {
        const client = merchantClient.getClient(logger);
        const merchantId = merchantClient.getMerchantId(logger);
        const sdkRequest = AdditionalPaymentActionMapper.toSdkRefundRequest(request);

        logger.info(`Refund for payment - Id: ${paymentId}, Amount: ${sdkRequest.amountOfMoney?.amount}`);

        const response = await client.payments.refundPayment(merchantId, paymentId, sdkRequest);

        if (!response.isSuccess) {
            logger.error(`Failed refund for payment - Status: ${response.status}`);
            throw ErrorMapper.fromSdkError(response.body, response.status);
        }

        logger.info(`Successful refund for payment.`);

        return AdditionalPaymentActionMapper.fromSdkRefundResponse(response.body);
    },

    async getPaymentDetailsById(paymentId: string, logger: FastifyBaseLogger): Promise<GetPaymentDetailsResponseDto> {
        const client = merchantClient.getClient(logger);
        const merchantId = merchantClient.getMerchantId(logger);

        logger.info(`Get details for payment with id: ${paymentId}.`);

        const response = await client.payments.getPaymentDetails(merchantId, paymentId);

        if (!response.isSuccess) {
            logger.error(`Failed to retrieve payment details for payment with id: ${paymentId}`);
            throw ErrorMapper.fromSdkError(response.body, response.status);
        }

        logger.info(`Payment details retrieved successfully.`);

        return PaymentDetailsMapper.fromSdkResponse(response.body);
    },
});
