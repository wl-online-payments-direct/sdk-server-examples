package com.onlinepayments.example.sdk.mappers;

import com.onlinepayments.domain.PaymentDetailsResponse;
import com.onlinepayments.example.service.dtos.paymentdetails.PaymentDetailsResponseDto;
import org.mapstruct.Mapper;

@Mapper(componentModel = "spring")
public interface PaymentDetailsMapper {
    PaymentDetailsResponseDto toResponseDto(PaymentDetailsResponse response);
}
