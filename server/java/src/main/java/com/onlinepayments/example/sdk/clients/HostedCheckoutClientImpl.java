package com.onlinepayments.example.sdk.clients;

import com.onlinepayments.ApiException;
import com.onlinepayments.domain.CreateHostedCheckoutRequest;
import com.onlinepayments.domain.CreateHostedCheckoutResponse;
import com.onlinepayments.domain.GetHostedCheckoutResponse;
import com.onlinepayments.example.sdk.mappers.ExceptionMapper;
import com.onlinepayments.example.sdk.mappers.HostedCheckoutMapper;
import com.onlinepayments.example.service.dtos.hostedcheckout.CreateHostedCheckoutRequestDto;
import com.onlinepayments.example.service.dtos.hostedcheckout.CreateHostedCheckoutResponseDto;
import com.onlinepayments.example.service.dtos.paymentbyhostedcheckoutid.GetPaymentByHostedCheckoutIdResponseDto;
import com.onlinepayments.example.service.interfaces.clients.HostedCheckoutClientInterface;
import com.onlinepayments.merchant.MerchantClient;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.stereotype.Component;

@Component
public class HostedCheckoutClientImpl implements HostedCheckoutClientInterface {

    private static final Logger logger = LoggerFactory.getLogger(HostedCheckoutClientImpl.class);
    private final MerchantClient merchantClient;
    private final HostedCheckoutMapper mapper;

    public HostedCheckoutClientImpl(MerchantClient merchantClient,
                                    HostedCheckoutMapper mapper) {
        this.merchantClient = merchantClient;
        this.mapper = mapper;
    }

    @Override
    public CreateHostedCheckoutResponseDto createHostedCheckout(CreateHostedCheckoutRequestDto requestDto) {
        try {
            CreateHostedCheckoutRequest sdkRequest = mapper.toSdkRequest(requestDto);

            logger.info("Creating hosted checkout request - Amount: {}; Currency: {}.",
                    sdkRequest.getOrder().getAmountOfMoney().getAmount(),
                    sdkRequest.getOrder().getAmountOfMoney().getCurrencyCode());

            CreateHostedCheckoutResponse sdkResponse = merchantClient.hostedCheckout()
                    .createHostedCheckout(sdkRequest);

            logger.info("Successful hosted checkout - Redirect URL: {}.", sdkResponse.getRedirectUrl());

            return mapper.toCreateResponseDto(sdkResponse);

        } catch (Exception ex) {
            logger.error("Error occurred while creating hosted checkout.", ex);
            throw ExceptionMapper.map(ex);
        }
    }

    @Override
    public GetPaymentByHostedCheckoutIdResponseDto getPaymentByHostedCheckoutId(String id) {
        try {
            logger.info("Getting details for payment with hosted checkout id: {}", id);

            GetHostedCheckoutResponse sdkResponse = merchantClient.hostedCheckout().getHostedCheckout(id);

            logger.info("Payment details successfully retrieved.");

            return mapper.toGetPaymentResponseDto(sdkResponse);

        } catch (ApiException ex) {
            logger.error("Error occurred while fetching payment details.", ex);
            throw ExceptionMapper.map(ex);
        }
    }
}