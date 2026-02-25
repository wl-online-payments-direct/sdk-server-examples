package com.onlinepayments.example.service.domain.common.enums;

public enum Country {
    England("GB"),
    Germany("DE"),
    France("FR");

    private final String sdkValue;

    Country(String sdkValue) {
        this.sdkValue = sdkValue;
    }

    public String getSdkValue() {
        return sdkValue;
    }
}