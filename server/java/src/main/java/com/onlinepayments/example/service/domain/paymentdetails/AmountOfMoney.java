package com.onlinepayments.example.service.domain.paymentdetails;

public record AmountOfMoney(
        Long amount,
        String currencyCode
) { }
