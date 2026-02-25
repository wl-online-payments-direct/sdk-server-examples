package com.onlinepayments.example.service.dtos.additionalpaymentactions;

import com.onlinepayments.example.service.domain.common.StatusOutput;
import com.onlinepayments.example.service.domain.common.enums.Status;

public record AdditionalPaymentActionResponseDto(
        String id,
        Status status,
        StatusOutput statusOutput
) { }
