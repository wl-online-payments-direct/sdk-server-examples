package com.onlinepayments.example.service.domain.paymentdetails;

public record AddressPersonal(
        String additionalInfo,
        String city,
        String companyName,
        String countryCode,
        String houseNumber,
        PersonalName name,
        String state,
        String street,
        String zip
) { }
