package com.onlinepayments.example.api.models.additionalpaymentactions;

import com.onlinepayments.example.service.domain.common.enums.Currency;

import java.math.BigDecimal;

public record AdditionalPaymentActionRequest(
        BigDecimal amount,
        Currency currency,
        Boolean isFinal
) {}
