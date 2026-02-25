package com.onlinepayments.example.service.domain.paymentdetails;

public record HostedCheckoutSpecificOutput(
        String hostedCheckoutId,
        String variant
) { }
