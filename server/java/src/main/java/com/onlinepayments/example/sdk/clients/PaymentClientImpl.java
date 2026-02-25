package com.onlinepayments.example.sdk.clients;

import com.onlinepayments.ApiException;
import com.onlinepayments.domain.*;
import com.onlinepayments.example.sdk.mappers.AdditionalPaymentActionMapper;
import com.onlinepayments.example.sdk.mappers.ExceptionMapper;
import com.onlinepayments.example.sdk.mappers.PaymentDetailsMapper;
import com.onlinepayments.example.sdk.mappers.PaymentMapper;
import com.onlinepayments.example.service.dtos.additionalpaymentactions.AdditionalPaymentActionRequestDto;
import com.onlinepayments.example.service.dtos.additionalpaymentactions.AdditionalPaymentActionResponseDto;
import com.onlinepayments.example.service.dtos.paymentdetails.PaymentDetailsResponseDto;
import com.onlinepayments.example.service.dtos.payments.CreatePaymentRequestDto;
import com.onlinepayments.example.service.dtos.payments.CreatePaymentResponseDto;
import com.onlinepayments.example.service.interfaces.clients.PaymentClientInterface;
import com.onlinepayments.merchant.MerchantClient;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.stereotype.Component;

@Component
public class PaymentClientImpl implements PaymentClientInterface {
    private static final Logger logger = LoggerFactory.getLogger(PaymentClientImpl.class);
    private final MerchantClient merchantClient;
    private final AdditionalPaymentActionMapper additionalPaymentActionMapper;
    private final PaymentMapper paymentMapper;
    private final PaymentDetailsMapper paymentDetailsMapper;

    public PaymentClientImpl(MerchantClient merchantClient, AdditionalPaymentActionMapper additionalPaymentActionMapper, PaymentMapper paymentMapper, PaymentDetailsMapper paymentDetailsMapper) {
        this.merchantClient = merchantClient;
        this.additionalPaymentActionMapper = additionalPaymentActionMapper;
        this.paymentMapper = paymentMapper;
        this.paymentDetailsMapper = paymentDetailsMapper;
    }

    @Override
    public CreatePaymentResponseDto createPayment(CreatePaymentRequestDto request) {
        try {
            CreatePaymentRequest requestSdk = paymentMapper.map(request);

            logger.info("Creating payment request for payment - Amount: {}; Currency: {}.",
                    requestSdk.getOrder().getAmountOfMoney().getAmount(),
                    requestSdk.getOrder().getAmountOfMoney().getCurrencyCode());

            CreatePaymentResponse response = merchantClient.payments().createPayment(requestSdk);

            logger.info("Successful payment with payment id: {}", response.getPayment().getId());

            return paymentMapper.map(response);
        } catch (Exception ex) {
            logger.error("Error occurred while creating payment.", ex);
            throw ExceptionMapper.map((ApiException) ex);
        }
    }

    @Override
    public AdditionalPaymentActionResponseDto capturePayment(AdditionalPaymentActionRequestDto requestDto) {
        try {
            CapturePaymentRequest sdkRequest = additionalPaymentActionMapper.toSdkCaptureRequest(requestDto);

            logger.info("Capturing payment - Id: {}; Amount: {}.",
                    requestDto.id(), sdkRequest.getAmount());

            CaptureResponse sdkResponse = merchantClient.payments().capturePayment(requestDto.id(), sdkRequest);

            logger.info("Payment successfully captured for payment id: {}.", requestDto.id());

            return additionalPaymentActionMapper.toCaptureResponseDto(sdkResponse);

        } catch (ApiException ex) {
            logger.error("Error occurred while capturing payment for id: {}.", requestDto.id(), ex);
            throw ExceptionMapper.map(ex);
        }
    }

    @Override
    public AdditionalPaymentActionResponseDto refundPayment(AdditionalPaymentActionRequestDto requestDto) {
        try {
            RefundRequest sdkRequest = additionalPaymentActionMapper.toSdkRefundRequest(requestDto);

            logger.info("Refunding payment - Id: {}; Amount: {}.",
                    requestDto.id(), sdkRequest.getAmountOfMoney().getAmount());

            RefundResponse sdkResponse = merchantClient.payments().refundPayment(requestDto.id(), sdkRequest);

            logger.info("Payment successfully refunded for payment id: {}.", requestDto.id());

            return additionalPaymentActionMapper.toRefundResponseDto(sdkResponse);

        } catch (ApiException ex) {
            logger.error("Error occurred while refunding payment for id: {}.", requestDto.id(), ex);
            throw ExceptionMapper.map(ex);
        }
    }


    @Override
    public AdditionalPaymentActionResponseDto cancelPayment(AdditionalPaymentActionRequestDto requestDto) {
        try {
            CancelPaymentRequest sdkRequest = additionalPaymentActionMapper.toSdkCancelRequest(requestDto);

            logger.info("Canceling payment - Id: {}; Amount: {}.",
                    requestDto.id(), sdkRequest.getAmountOfMoney().getAmount());

            CancelPaymentResponse sdkResponse = merchantClient.payments().cancelPayment(requestDto.id(), sdkRequest);

            logger.info("Payment successfully canceled for payment id: {}.", requestDto.id());

            return additionalPaymentActionMapper.toCancelResponseDto(sdkResponse);

        } catch (ApiException ex) {
            logger.error("Error occurred while canceling payment for id: {}.", requestDto.id(), ex);
            throw ExceptionMapper.map(ex);
        }
    }

    public PaymentDetailsResponseDto getPaymentDetailsById(String id) {
        try {
            logger.info("Getting details for payment with id: {}", id);

            PaymentDetailsResponse sdkResponse = merchantClient.payments().getPaymentDetails(id);

            logger.info("Payment details successfully retrieved.");

            return paymentDetailsMapper.toResponseDto(sdkResponse);

        } catch (ApiException ex) {
            logger.error("Error occurred while fetching payment details.", ex);
            throw ExceptionMapper.map(ex);
        }
    }

}
