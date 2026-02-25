package com.onlinepayments.example.service.domain.paymentdetails;

public record PaymentReferences(
        String merchantReference,
        String merchantParameters
) { }
