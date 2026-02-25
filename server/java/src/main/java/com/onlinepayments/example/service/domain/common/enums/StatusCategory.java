package com.onlinepayments.example.service.domain.common.enums;

public enum StatusCategory {
    CREATED,
    UNSUCCESSFUL,
    PENDING_PAYMENT,
    PENDING_MERCHANT,
    PENDING_CONNECT_OR_3RD_PARTY,
    COMPLETED,
    REVERSED,
    REFUNDED
}
