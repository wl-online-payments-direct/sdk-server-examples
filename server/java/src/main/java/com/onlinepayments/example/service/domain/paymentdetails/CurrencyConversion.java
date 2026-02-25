package com.onlinepayments.example.service.domain.paymentdetails;

public record CurrencyConversion(
        Boolean acceptedByUser,
        DccProposal proposal
) { }
