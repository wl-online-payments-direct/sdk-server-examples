package com.onlinepayments.example.service.domain.paymentdetails;

public record MobilePaymentMethodSpecificOutput(
        String authorisationCode,
        CardFraudResults fraudResults,
        String network,
        MobilePaymentData paymentData,
        Integer paymentProductId,
        ThreeDSecureResults threeDSecureResults
) { }
