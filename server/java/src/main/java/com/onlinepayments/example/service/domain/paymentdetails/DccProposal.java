package com.onlinepayments.example.service.domain.paymentdetails;

public record DccProposal(
        AmountOfMoney baseAmount,
        String disclaimerDisplay,
        String disclaimerReceipt,
        RateDetails rate,
        AmountOfMoney targetAmount
) { }
