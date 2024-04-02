package com.worldlinesolutions.onlinepayments.example.hostedcheckout;

import com.onlinepayments.domain.CreateHostedCheckoutRequest;
import com.onlinepayments.domain.CreateHostedCheckoutResponse;
import com.onlinepayments.merchant.MerchantClientInterface;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.stereotype.Service;

/**
 * Hosted checkout service used for hosted checkout scenarios
 */
@Service
public class HostedCheckoutService {

    private static Logger log = LoggerFactory.getLogger(HostedCheckoutService.class);

    private final MerchantClientInterface merchantClient;

    public HostedCheckoutService(
            MerchantClientInterface merchantClientFromCommunicator
    ) {
        this.merchantClient = merchantClientFromCommunicator;
    }

    /**
     * Creates a hosted checkout request by using the {@link this#merchantClient}
     * @param hostedCheckoutRequest {@link CreateHostedCheckoutRequest}
     * @return {@link CreateHostedCheckoutResponse}
     */
    public CreateHostedCheckoutResponse createHostedCheckoutResponse(CreateHostedCheckoutRequest hostedCheckoutRequest) {
        log.info("Creating hosted checkout request for payment {} {}",
                hostedCheckoutRequest.getOrder().getAmountOfMoney().getAmount(),
                hostedCheckoutRequest.getOrder().getAmountOfMoney().getCurrencyCode()
        );
        CreateHostedCheckoutResponse hostedCheckoutResponse = merchantClient.hostedCheckout().createHostedCheckout(hostedCheckoutRequest);
        log.info("Successful hosted checkout - Return url: {}", hostedCheckoutResponse.getRedirectUrl());
        return  hostedCheckoutResponse;
    }

}
