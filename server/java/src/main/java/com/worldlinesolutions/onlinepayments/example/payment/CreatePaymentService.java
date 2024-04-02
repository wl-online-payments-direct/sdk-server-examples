package com.worldlinesolutions.onlinepayments.example.payment;

import com.onlinepayments.domain.CreatePaymentRequest;
import com.onlinepayments.domain.CreatePaymentResponse;
import com.onlinepayments.merchant.MerchantClientInterface;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import org.springframework.stereotype.Service;

/**
 * Create payment service used for create payment scenarios
 */
@Service
public class CreatePaymentService {

    private static Logger log = LoggerFactory.getLogger(CreatePaymentService.class);

    private final MerchantClientInterface merchantClient;

    public CreatePaymentService(
            MerchantClientInterface merchantClientFromCommunicator
    ) {
        this.merchantClient = merchantClientFromCommunicator;
    }

    /**
     * Creates a payment from hosted tokenization scenario
     * @param createPaymentRequest {@link CreatePaymentRequest} that originates from Hosted Tokenization
     * @return Instance of {@link CreatePaymentResponse}
     */
    public CreatePaymentResponse createHostedTokenizationPayment(CreatePaymentRequest createPaymentRequest) {
        log.info("Creating hosted checkout request for payment {} {} and hosted tokenization id {}",
                createPaymentRequest.getOrder().getAmountOfMoney().getAmount(),
                createPaymentRequest.getOrder().getAmountOfMoney().getCurrencyCode(),
                createPaymentRequest.getHostedTokenizationId()
        );
        CreatePaymentResponse paymentResponse = merchantClient.payments().createPayment(createPaymentRequest);
        log.info("Successful payment with payment id {}", paymentResponse.getPayment().getId());
        return  paymentResponse;
    }

    /**
     * Creates a payment for payment scenario (Basic, 3DS ...)
     * @param createPaymentRequest {@link CreatePaymentRequest} that originates from Create Payment scenarios
     * @return Instance of {@link CreatePaymentResponse}
     */
    public CreatePaymentResponse createPayment(CreatePaymentRequest createPaymentRequest) {
        log.info("Creating payment request for {} {}",
                createPaymentRequest.getOrder().getAmountOfMoney().getAmount(),
                createPaymentRequest.getOrder().getAmountOfMoney().getCurrencyCode()
        );
        CreatePaymentResponse paymentResponse = merchantClient.payments().createPayment(createPaymentRequest);
        log.info("Successful payment with payment id {}", paymentResponse.getPayment().getId());
        return  paymentResponse;
    }
}
