package com.onlinepayments.example.api.models.paymentlinks;

import com.onlinepayments.example.service.domain.common.enums.Currency;
import com.onlinepayments.example.service.domain.paymentlinks.Status;

import java.math.BigDecimal;

public record CreatePaymentLinkResponse(
        String paymentLinkId,
        String redirectUrl,
        Status status,
        BigDecimal amount,
        Currency currency
) {}
