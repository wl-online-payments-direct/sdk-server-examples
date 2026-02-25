package com.onlinepayments.example.service.domain.paymentdetails;

public record AcquirerInformation(
        AcquirerSelectionInformation acquirerSelectionInformation,
        String name
) { }
