package com.onlinepayments.example.service.dtos.paymentlinks;

import com.onlinepayments.example.service.domain.common.enums.Currency;
import com.onlinepayments.example.service.domain.paymentlinks.Action;
import com.onlinepayments.example.service.domain.paymentlinks.ValidityPeriod;

import java.math.BigDecimal;

public record CreatePaymentLinkRequestDto(
        BigDecimal amount,
        Currency currency,
        String description,
        ValidityPeriod validFor,
        Action action
) { }
