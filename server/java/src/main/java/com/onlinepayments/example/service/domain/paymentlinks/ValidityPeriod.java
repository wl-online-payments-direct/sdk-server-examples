package com.onlinepayments.example.service.domain.paymentlinks;

import com.fasterxml.jackson.annotation.JsonCreator;

import java.util.Arrays;
import java.util.stream.Collectors;

public enum ValidityPeriod {
    OneDay(24),
    TwoDays(48),
    TwoWeeks(336),
    OneMonth(720);

    private final int value;

    ValidityPeriod(int value) {
        this.value = value;
    }

    @JsonCreator
    public static ValidityPeriod fromValue(int value) {
        for (ValidityPeriod vp : values()) {
            if (vp.value == value) return vp;
        }

        String allowed = Arrays.stream(values())
                .map(vp -> String.valueOf(vp.getValue()))
                .collect(Collectors.joining(", "));

        throw new IllegalArgumentException(
                "The ValidFor field is invalid and must be a number from the following set: " + allowed + "."
        );    }

    public int getValue() {
        return value;
    }
}
