package com.onlinepayments.example.service.domain.paymentdetails;

public record PaymentProduct5001SpecificOutput(
    String accountNumber,
    String authorisationCode,
    String liability,
    String mobilePhoneNumber,
    String operationCode
) { }
