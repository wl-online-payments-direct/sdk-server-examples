package com.onlinepayments.example.service.domain.paymentdetails;

public record Address(
        String additionalInfo,
        String city,
        String countryCode,
        String houseNumber,
        String state,
        String street,
        String zip
) { }
