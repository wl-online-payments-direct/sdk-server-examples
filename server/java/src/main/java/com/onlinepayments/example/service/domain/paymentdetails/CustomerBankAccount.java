package com.onlinepayments.example.service.domain.paymentdetails;

public record CustomerBankAccount(
        String accountHolderName,
        String bic,
        String iban
) { }
