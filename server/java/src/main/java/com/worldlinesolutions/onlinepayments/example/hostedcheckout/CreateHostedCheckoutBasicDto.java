package com.worldlinesolutions.onlinepayments.example.hostedcheckout;

import java.math.BigDecimal;

/**
 * Basic Dto for hosted checkout used for testing purposes
 */
public class CreateHostedCheckoutBasicDto {

    private BigDecimal amount;

    private String currency;

    private String redirectUrl;

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

    public String getRedirectUrl() {
        return redirectUrl;
    }

    public void setRedirectUrl(String redirectUrl) {
        this.redirectUrl = redirectUrl;
    }
}
