package com.onlinepayments.example.api.mappers;

import com.onlinepayments.example.api.models.paymentlinks.CreatePaymentLinkRequest;
import com.onlinepayments.example.api.models.paymentlinks.CreatePaymentLinkResponse;
import com.onlinepayments.example.service.dtos.paymentlinks.CreatePaymentLinkRequestDto;
import com.onlinepayments.example.service.dtos.paymentlinks.CreatePaymentLinkResponseDto;
import org.mapstruct.Mapper;

@Mapper(componentModel = "spring")
public interface PaymentLinkApiMapper {
    CreatePaymentLinkRequestDto toRequestDto(CreatePaymentLinkRequest request);

    CreatePaymentLinkResponse toApiResponse(CreatePaymentLinkResponseDto responseDto);
}
