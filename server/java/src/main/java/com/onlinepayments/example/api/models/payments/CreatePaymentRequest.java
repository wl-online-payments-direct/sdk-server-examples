package com.onlinepayments.example.api.models.payments;

import com.onlinepayments.example.service.domain.common.Address;
import com.onlinepayments.example.service.domain.common.enums.Currency;
import com.onlinepayments.example.service.domain.payments.enums.PaymentMethodType;
import com.onlinepayments.example.service.domain.payments.Card;
import com.onlinepayments.example.service.domain.payments.Mandate;

import java.math.BigDecimal;

public record CreatePaymentRequest(
        BigDecimal amount,
        Currency currency,
        PaymentMethodType method,
        String hostedTokenizationId,
        Address shippingAddress,
        Address billingAddress,
        Card card,
        Mandate mandate
) { }
