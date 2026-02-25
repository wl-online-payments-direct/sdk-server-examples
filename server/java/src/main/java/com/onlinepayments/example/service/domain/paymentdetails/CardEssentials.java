package com.onlinepayments.example.service.domain.paymentdetails;

public record CardEssentials(
        String bin,
        String cardNumber,
        String CountryCode,
        String ExpiryDate
) { }
