package com.onlinepayments.example.service.domain.paymentdetails;

public record PaymentOutput(
        AmountOfMoney amountOfMoney,
        PaymentReferences references,
        AmountOfMoney acquiredAmount,
        CustomerOutput customer,
        CardPaymentMethodSpecificOutput cardPaymentMethodSpecificOutput,
        String paymentMethod,
        String merchantParameters,
        Long amountPaid,
        Discount discount,
        SurchargeSpecificOutput surchargeSpecificOutput,
        SepaDirectDebitPaymentMethodSpecificOutput sepaDirectDebitPaymentMethodSpecificOutput,
        RedirectPaymentMethodSpecificOutput redirectPaymentMethodSpecificOutput,
        MobilePaymentMethodSpecificOutput mobilePaymentMethodSpecificOutput
) { }
