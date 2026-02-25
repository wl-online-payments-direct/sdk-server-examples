package com.onlinepayments.example.service.domain.paymentdetails;

public record AcquirerSelectionInformation(
        Integer fallbackLevel,
        String result,
        String ruleName
) { }
