package com.onlinepayments.example.service.dtos.hostedcheckout;

import com.onlinepayments.example.service.domain.common.Address;
import com.onlinepayments.example.service.domain.common.enums.Currency;
import com.onlinepayments.example.service.domain.common.enums.Language;

import java.math.BigDecimal;

public record CreateHostedCheckoutRequestDto(
        BigDecimal amount,
        Currency currency,
        Language language,
        String redirectUrl,
        Address shippingAddress,
        Address billingAddress
) { }
