package com.onlinepayments.example.api.models.hostedcheckout;

import com.onlinepayments.example.service.domain.common.enums.Currency;

import java.math.BigDecimal;

public record CreateHostedCheckoutResponse(
        String hostedCheckoutId,
        String redirectUrl,
        String returnMAC,
        BigDecimal amount,
        Currency currency
) { }
