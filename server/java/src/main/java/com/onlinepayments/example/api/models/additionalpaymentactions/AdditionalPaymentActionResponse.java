package com.onlinepayments.example.api.models.additionalpaymentactions;

import com.onlinepayments.example.service.domain.common.enums.Status;
import com.onlinepayments.example.service.domain.common.StatusOutput;

public record AdditionalPaymentActionResponse(
        String id,
        Status status,
        StatusOutput statusOutput
) { }
