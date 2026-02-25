package com.onlinepayments.example.sdk.clients;

import com.onlinepayments.domain.CreatePaymentLinkRequest;
import com.onlinepayments.domain.PaymentLinkResponse;
import com.onlinepayments.example.sdk.mappers.ExceptionMapper;
import com.onlinepayments.example.sdk.mappers.PaymentLinkMapper;
import com.onlinepayments.example.service.dtos.paymentlinks.CreatePaymentLinkRequestDto;
import com.onlinepayments.example.service.dtos.paymentlinks.CreatePaymentLinkResponseDto;
import com.onlinepayments.example.service.interfaces.clients.PaymentLinkClientInterface;
import com.onlinepayments.merchant.MerchantClient;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.stereotype.Component;

@Component
public class PaymentLinkClientImpl implements PaymentLinkClientInterface {

    private static final Logger logger = LoggerFactory.getLogger(PaymentLinkClientImpl.class);
    private final MerchantClient merchantClient;
    private final PaymentLinkMapper mapper;

    public PaymentLinkClientImpl(MerchantClient merchantClient,
                                 PaymentLinkMapper mapper) {
        this.merchantClient = merchantClient;
        this.mapper = mapper;
    }

    @Override
    public CreatePaymentLinkResponseDto createPaymentLink(CreatePaymentLinkRequestDto requestDto) {
        try {
            CreatePaymentLinkRequest sdkRequest = mapper.toSdkRequest(requestDto);

            logger.info("Creating payment link request for payment - Amount: {}; Currency: {}.",
                    sdkRequest.getOrder().getAmountOfMoney().getAmount(),
                    sdkRequest.getOrder().getAmountOfMoney().getCurrencyCode());

            PaymentLinkResponse sdkResponse = merchantClient.paymentLinks().createPaymentLink(sdkRequest);

            logger.info("Successful payment link - Redirect URL: {}.", sdkResponse.getRedirectionUrl());

            return mapper.toResponseDto(sdkResponse);

        } catch (Exception ex) {
            logger.error("Error occurred while creating payment link.", ex);
            throw ExceptionMapper.map(ex);
        }
    }
}