package com.worldlinesolutions.onlinepayments.example.hostedtokenization;

import com.onlinepayments.domain.CreateHostedTokenizationRequest;
import com.onlinepayments.domain.CreateHostedTokenizationResponse;
import com.onlinepayments.merchant.MerchantClientInterface;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.stereotype.Service;

/**
 * Hosted tokenization service used for hosted tokenization scenarios
 */
@Service
public class HostedTokenizationService {

    private static Logger log = LoggerFactory.getLogger(HostedTokenizationService.class);

    private final MerchantClientInterface merchantClient;

    public HostedTokenizationService(
            MerchantClientInterface merchantClientFromCommunicator
    ) {
        this.merchantClient = merchantClientFromCommunicator;
    }

    /**
     * Initialize hosted tokenization response
     * @return {@link CreateHostedTokenizationResponse}
     */
    public CreateHostedTokenizationResponse initHostedTokenization() {
        log.info("Initializing hosted tokenization ...");
        CreateHostedTokenizationResponse hostedTokenizationResponse = merchantClient.hostedTokenization().createHostedTokenization(new CreateHostedTokenizationRequest());
        log.info("Successful initialization for hosted tokenization - Hosted Tokenization Url: {}", hostedTokenizationResponse.getHostedTokenizationUrl());
        return  hostedTokenizationResponse;
    }

}
