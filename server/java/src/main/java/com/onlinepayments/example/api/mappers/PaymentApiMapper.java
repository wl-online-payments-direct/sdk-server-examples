package com.onlinepayments.example.api.mappers;

import com.onlinepayments.example.api.models.payments.CreatePaymentRequest;
import com.onlinepayments.example.api.models.payments.CreatePaymentResponse;
import com.onlinepayments.example.service.dtos.payments.CreatePaymentRequestDto;
import com.onlinepayments.example.service.dtos.payments.CreatePaymentResponseDto;
import org.mapstruct.Mapper;

@Mapper(componentModel = "spring")
public interface PaymentApiMapper {
    CreatePaymentRequestDto toRequestDto(CreatePaymentRequest request);

    CreatePaymentResponse toApiResponse(CreatePaymentResponseDto responseDto);
}
