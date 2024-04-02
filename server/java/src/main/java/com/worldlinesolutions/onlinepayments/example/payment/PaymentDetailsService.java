package com.worldlinesolutions.onlinepayments.example.payment;

import com.onlinepayments.domain.PaymentDetailsResponse;
import com.onlinepayments.merchant.MerchantClientInterface;
import org.springframework.stereotype.Service;

/**
 * Payment details service used for fetching payment details
 */
@Service
public class PaymentDetailsService {

    private final MerchantClientInterface merchantClient;

    public PaymentDetailsService(
            MerchantClientInterface merchantClientFromCommunicator
    ) {
        this.merchantClient = merchantClientFromCommunicator;
    }

    /**
     * Gets payment details for a hostedCheckoutId
     * @param hostedCheckoutId Id of the hosted checkout
     * @return Instance of {@link PaymentDetailsResponse}
     */
    public PaymentDetailsResponse getPaymentDetailsForHostedCheckout(String hostedCheckoutId) {
        String paymentId = String.format("%s_0", hostedCheckoutId);
        return merchantClient.payments().getPaymentDetails(paymentId);
    }

    /**
     * Gets payment details for a payment id
     * @param paymentId Id of the payment
     * @return Instance of {@link PaymentDetailsResponse}
     */
    public PaymentDetailsResponse getPaymentDetails(String paymentId) {
        return merchantClient.payments().getPaymentDetails(paymentId);
    }
}
