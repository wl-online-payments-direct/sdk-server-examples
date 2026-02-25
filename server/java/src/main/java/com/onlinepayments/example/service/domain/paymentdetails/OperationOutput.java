package com.onlinepayments.example.service.domain.paymentdetails;

public record OperationOutput(
        AmountOfMoney amountOfMoney,
        String id,
        OperationPaymentReferences operationReferences,
        String paymentMethod,
        PaymentReferences references,
        String status,
        PaymentStatusOutput statusOutput
) { }
