package com.onlinepayments.example.service.domain.paymentdetails;

public record ReattemptInstructionsConditions(
    Integer maxAttempts,
    Integer maxDelay
) { }
