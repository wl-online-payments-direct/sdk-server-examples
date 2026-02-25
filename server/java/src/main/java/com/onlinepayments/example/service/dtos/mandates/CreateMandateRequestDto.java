package com.onlinepayments.example.service.dtos.mandates;

import com.onlinepayments.example.service.domain.payments.Mandate;

public record CreateMandateRequestDto(
        Mandate mandate
) {
}
