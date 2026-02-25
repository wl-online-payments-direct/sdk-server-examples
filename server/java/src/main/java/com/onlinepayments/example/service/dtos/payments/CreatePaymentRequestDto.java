package com.onlinepayments.example.service.dtos.payments;

import com.onlinepayments.example.service.domain.common.Address;
import com.onlinepayments.example.service.domain.common.enums.Currency;
import com.onlinepayments.example.service.domain.payments.enums.PaymentMethodType;
import com.onlinepayments.example.service.domain.payments.Card;
import com.onlinepayments.example.service.domain.payments.Mandate;

import java.math.BigDecimal;

public class CreatePaymentRequestDto {
    private final BigDecimal amount;
    private final Currency currency;
    private final PaymentMethodType method;
    private final String hostedTokenizationId;
    private final Address shippingAddress;
    private final Address billingAddress;
    private final Card card;
    private Mandate mandate;
    private Integer paymentProductId;

    public CreatePaymentRequestDto(BigDecimal amount, Currency currency, PaymentMethodType method,
                                   String hostedTokenizationId, Address shippingAddress,
                                   Address billingAddress, Card card, Mandate mandate, Integer paymentProductId) {
        this.amount = amount;
        this.currency = currency;
        this.method = method;
        this.hostedTokenizationId = hostedTokenizationId;
        this.shippingAddress = shippingAddress;
        this.billingAddress = billingAddress;
        this.card = card;
        this.mandate = mandate;
        this.paymentProductId = paymentProductId;
    }

    public BigDecimal getAmount() { return amount; }
    public Currency getCurrency() { return currency; }
    public PaymentMethodType getMethod() { return method; }
    public String getHostedTokenizationId() { return hostedTokenizationId; }
    public Address getShippingAddress() { return shippingAddress; }
    public Address getBillingAddress() { return billingAddress; }
    public Card getCard() { return card; }
    public Mandate getMandate() { return mandate; }
    public void setMandate(Mandate mandate) { this.mandate = mandate; }
    public Integer getPaymentProductId() {
        return paymentProductId;
    }
    public void setPaymentProductId(Integer paymentProductId) {
        this.paymentProductId = paymentProductId;
    }
}

