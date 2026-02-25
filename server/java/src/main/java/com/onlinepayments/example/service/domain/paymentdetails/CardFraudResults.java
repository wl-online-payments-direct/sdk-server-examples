package com.onlinepayments.example.service.domain.paymentdetails;

public record CardFraudResults(
        String fraudServiceResult,
        String avsResult,
        String cvvResult
) { }
