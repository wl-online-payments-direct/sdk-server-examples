package com.onlinepayments.example.api.models.paymentbyhostedcheckoutid;

public record GetPaymentByHostedCheckoutIdResponse(
        String status,
        String paymentId
) {
}