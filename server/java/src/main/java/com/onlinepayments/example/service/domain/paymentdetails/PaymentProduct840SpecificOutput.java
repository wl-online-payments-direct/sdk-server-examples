package com.onlinepayments.example.service.domain.paymentdetails;

public record PaymentProduct840SpecificOutput(
        Address billingAddress,
        PaymentProduct840CustomerAccount customerAccount,
        Address customerAddress,
        ProtectionEligibility protectionEligibility
) { }
