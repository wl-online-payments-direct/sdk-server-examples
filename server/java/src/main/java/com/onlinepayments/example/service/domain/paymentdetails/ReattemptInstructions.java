package com.onlinepayments.example.service.domain.paymentdetails;

public record ReattemptInstructions(
    ReattemptInstructionsConditions conditions,
    Integer frozenPeriod,
    String indicator
) { }
