package com.worldlinesolutions.onlinepayments.example.hostedtokenization;

import java.math.BigDecimal;

/**
 * Basic Dto for hosted tokenization used for testing purposes
 */
public class CreateHostedTokenizationBasicDto {

    private BigDecimal amount;

    private String currency;

    private String hostedTokenizationId;

    public BigDecimal getAmount() {
        return amount;
    }

    public void setAmount(BigDecimal amount) {
        this.amount = amount;
    }

    public String getCurrency() {
        return currency;
    }

    public void setCurrency(String currency) {
        this.currency = currency;
    }

    public String getHostedTokenizationId() {
        return hostedTokenizationId;
    }

    public void setHostedTokenizationId(String hostedTokenizationId) {
        this.hostedTokenizationId = hostedTokenizationId;
    }
}
