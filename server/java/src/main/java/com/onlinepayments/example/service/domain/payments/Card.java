package com.onlinepayments.example.service.domain.payments;

public record Card(
        String number,
        String holderName,
        String verificationCode,
        String expiryMonth,
        String expiryYear
) {}
