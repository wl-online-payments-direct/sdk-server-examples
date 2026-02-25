package com.onlinepayments.example.service.dtos.additionalpaymentactions;

import com.onlinepayments.example.service.domain.common.enums.Currency;

import java.math.BigDecimal;

public record AdditionalPaymentActionRequestDto(
        String id,
        BigDecimal amount,
        Currency currency,
        Boolean isFinal
) { }
