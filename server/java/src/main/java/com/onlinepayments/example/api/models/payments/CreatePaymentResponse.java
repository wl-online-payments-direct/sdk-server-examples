package com.onlinepayments.example.api.models.payments;

import com.onlinepayments.example.service.domain.common.enums.Status;
import com.onlinepayments.example.service.domain.common.StatusOutput;

public record CreatePaymentResponse(
        String id,
        Status status,
        StatusOutput statusOutput
) { }
