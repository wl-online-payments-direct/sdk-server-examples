package com.onlinepayments.example.service.domain.paymentdetails;

public record APIError(
        String category,
        String code,
        String errorCode,
        Integer httpStatusCode,
        String id,
        String message,
        String propertyName,
        Boolean retriable
) { }
