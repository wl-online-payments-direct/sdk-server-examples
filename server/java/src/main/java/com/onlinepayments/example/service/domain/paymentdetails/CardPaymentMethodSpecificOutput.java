package com.onlinepayments.example.service.domain.paymentdetails;

public record CardPaymentMethodSpecificOutput(
        AcquirerInformation acquirerInformation,
        String authorisationCode,
        CardEssentials card,
        CardFraudResults fraudResults,
        String paymentAccountReference,
        Integer paymentProductId,
        ThreeDSecureResults threeDSecureResults,
        String initialSchemeTransactionId,
        String schemeReferenceData,
        String token,
        String paymentOption,
        ExternalTokenLinked externalTokenLinked,
        Long authenticatedAmount,
        CurrencyConversion currencyConversion,
        PaymentProduct3208SpecificOutput paymentProduct3208SpecificOutput,
        PaymentProduct3209SpecificOutput paymentProduct3209SpecificOutput,
        ReattemptInstructions reattemptInstructions
) { }
