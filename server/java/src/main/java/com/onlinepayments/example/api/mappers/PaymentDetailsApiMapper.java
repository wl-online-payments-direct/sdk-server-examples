package com.onlinepayments.example.api.mappers;

import com.onlinepayments.example.api.models.paymentdetails.PaymentDetailsResponse;
import com.onlinepayments.example.service.dtos.paymentdetails.PaymentDetailsResponseDto;
import org.mapstruct.Mapper;

@Mapper(componentModel = "spring")
public interface PaymentDetailsApiMapper {
    PaymentDetailsResponse toApiResponse(PaymentDetailsResponseDto responseDto);
}
