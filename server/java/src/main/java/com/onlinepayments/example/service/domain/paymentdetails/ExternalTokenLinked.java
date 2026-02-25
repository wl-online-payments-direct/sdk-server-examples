package com.onlinepayments.example.service.domain.paymentdetails;

public record ExternalTokenLinked(
        String gtsComputedToken,
        String computedToken,
        String generatedToken
) { }
