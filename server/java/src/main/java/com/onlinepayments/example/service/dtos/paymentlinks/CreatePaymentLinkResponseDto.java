package com.onlinepayments.example.service.dtos.paymentlinks;

import com.onlinepayments.example.service.domain.common.enums.Currency;
import com.onlinepayments.example.service.domain.paymentlinks.Status;

import java.math.BigDecimal;

public record CreatePaymentLinkResponseDto (
        String paymentLinkId,
        String redirectUrl,
        Status status,
        BigDecimal amount,
        Currency currency
) { }

