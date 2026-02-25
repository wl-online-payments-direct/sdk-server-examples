package com.onlinepayments.example.service.domain.paymentdetails;

public record SepaDirectDebitPaymentMethodSpecificOutput(
        FraudResults fraudResults,
        PaymentProduct771SpecificOutput paymentProduct771SpecificOutput,
        Integer paymentProductId
) { }
