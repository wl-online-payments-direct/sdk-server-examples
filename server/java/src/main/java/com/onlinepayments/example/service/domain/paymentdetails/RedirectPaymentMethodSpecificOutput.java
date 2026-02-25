package com.onlinepayments.example.service.domain.paymentdetails;

public record RedirectPaymentMethodSpecificOutput(
        String authorisationCode,
        CustomerBankAccount customerBankAccount,
        FraudResults fraudResults,
        String paymentOption,
        PaymentProduct3203SpecificOutput paymentProduct3203SpecificOutput,
        PaymentProduct5001SpecificOutput paymentProduct5001SpecificOutput,
        PaymentProduct5402SpecificOutput paymentProduct5402SpecificOutput,
        PaymentProduct5500SpecificOutput paymentProduct5500SpecificOutput,
        PaymentProduct840SpecificOutput paymentProduct840SpecificOutput,
        Integer paymentProductId,
        String token
) { }
