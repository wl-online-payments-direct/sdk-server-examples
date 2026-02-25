package com.onlinepayments.example.service.domain.paymentdetails;

import java.math.BigDecimal;

public record RateDetails(
        BigDecimal exchangeRate,
        BigDecimal invertedExchangeRate,
        BigDecimal markupRate,
        String quotationDateTime,
        String source
) { }
