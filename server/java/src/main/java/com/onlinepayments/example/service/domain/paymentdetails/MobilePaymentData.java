package com.onlinepayments.example.service.domain.paymentdetails;

public record MobilePaymentData(
        String dpan,
        String expiryDate
) { }
