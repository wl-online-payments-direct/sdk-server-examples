package com.onlinepayments.example.service.dtos.paymentbyhostedcheckoutid;

public record GetPaymentByHostedCheckoutIdResponseDto(
        String status,
        String paymentId
) {
}