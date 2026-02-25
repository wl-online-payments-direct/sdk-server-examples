package com.onlinepayments.example.service.interfaces.clients;

import com.onlinepayments.example.service.domain.payments.Mandate;
import com.onlinepayments.example.service.dtos.mandates.CreateMandateRequestDto;
import com.onlinepayments.example.service.dtos.mandates.GetMandateResponseDto;

public interface MandateClientInterface {
    Mandate createMandate(CreateMandateRequestDto request);

    GetMandateResponseDto getMandate(String existingUniqueMandateReference);
}
