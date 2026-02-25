package com.onlinepayments.example.service.domain.paymentdetails;

public record PaymentProduct840CustomerAccount(
        String accountId,
        String companyName,
        String countryCode,
        String customerAccountStatus,
        String customerAddressStatus,
        String firstName,
        String payerId,
        String surname
) { }
