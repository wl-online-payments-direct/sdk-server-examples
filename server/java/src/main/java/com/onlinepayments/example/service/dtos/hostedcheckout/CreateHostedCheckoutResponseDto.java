package com.onlinepayments.example.service.dtos.hostedcheckout;

import com.onlinepayments.example.service.domain.common.enums.Currency;

import java.math.BigDecimal;

public record CreateHostedCheckoutResponseDto(
        String hostedCheckoutId,
        String redirectUrl,
        String returnMAC,
        BigDecimal amount,
        Currency currency
) { }
