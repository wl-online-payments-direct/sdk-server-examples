package com.onlinepayments.example.sdk.clients;

import com.onlinepayments.domain.CreateHostedTokenizationRequest;
import com.onlinepayments.domain.CreateHostedTokenizationResponse;
import com.onlinepayments.example.sdk.mappers.ExceptionMapper;
import com.onlinepayments.example.sdk.mappers.HostedTokenizationMapper;
import com.onlinepayments.example.service.dtos.hostedtokenization.GetHostedTokenizationResponseDto;
import com.onlinepayments.example.service.interfaces.clients.HostedTokenizationClientInterface;
import com.onlinepayments.merchant.MerchantClient;
import org.slf4j.LoggerFactory;
import org.springframework.stereotype.Component;

@Component
public class HostedTokenizationClientImpl implements HostedTokenizationClientInterface {
    private static final org.slf4j.Logger logger = LoggerFactory.getLogger(HostedTokenizationClientImpl.class);
    private final MerchantClient merchantClient;
    private final HostedTokenizationMapper mapper;

    public HostedTokenizationClientImpl(MerchantClient merchantClient, HostedTokenizationMapper mapper) {
        this.merchantClient = merchantClient;
        this.mapper = mapper;
    }

    @Override
    public GetHostedTokenizationResponseDto initHostedTokenization() {
        try {
            logger.info("The generation of the hosted tokenization ID has started.");

            CreateHostedTokenizationRequest sdkRequest = new CreateHostedTokenizationRequest();

            CreateHostedTokenizationResponse sdkResponse = merchantClient.hostedTokenization()
                    .createHostedTokenization(sdkRequest);

            logger.info("Generation of the hosted tokenization ID successfully completed - HostedTokenizationId: {}.",
                    sdkResponse.getHostedTokenizationId());

            return mapper.toResponseDto(sdkResponse);

        } catch (Exception ex) {
            logger.error("Error occurred while creating hosted tokenization.", ex);
            throw ExceptionMapper.map(ex);
        }
    }
}
