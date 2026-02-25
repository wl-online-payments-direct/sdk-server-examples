package com.onlinepayments.example.service.dtos.payments;

import com.onlinepayments.example.service.domain.common.enums.Status;
import com.onlinepayments.example.service.domain.common.StatusOutput;

public record CreatePaymentResponseDto(
        String id,
        Status status,
        StatusOutput statusOutput
) {}
