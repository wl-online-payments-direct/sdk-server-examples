package com.onlinepayments.example.api.models.hostedcheckout;

import com.onlinepayments.example.service.domain.common.Address;
import com.onlinepayments.example.service.domain.common.enums.Currency;
import com.onlinepayments.example.service.domain.common.enums.Language;

import java.math.BigDecimal;

public record CreateHostedCheckoutRequest(
        BigDecimal amount,
        Currency currency,
        Language language,
        String redirectUrl,
        Address shippingAddress,
        Address billingAddress
) { }
