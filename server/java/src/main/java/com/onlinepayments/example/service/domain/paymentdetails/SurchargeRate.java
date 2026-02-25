package com.onlinepayments.example.service.domain.paymentdetails;

import java.math.BigDecimal;

public record SurchargeRate(
    BigDecimal adValoremRate,
    Integer specificRate,
    String surchargeProductTypeId,
    String surchargeProductTypeVersion
) { }
