package com.onlinepayments.example.service.domain.paymentdetails;

public record SurchargeSpecificOutput(
    String mode,
    AmountOfMoney surchargeAmount,
    SurchargeRate surchargeRate
) { }
