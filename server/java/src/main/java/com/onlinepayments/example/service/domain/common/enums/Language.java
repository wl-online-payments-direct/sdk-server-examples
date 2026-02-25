package com.onlinepayments.example.service.domain.common.enums;

public enum Language {
    English("en"),
    German("de"),
    French("fr");

    private final String sdkValue;

    Language(String sdkValue) {
        this.sdkValue = sdkValue;
    }

    public String getSdkValue() {
        return sdkValue;
    }
}
