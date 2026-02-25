package com.onlinepayments.example.api.mappers;

import com.onlinepayments.example.api.models.additionalpaymentactions.AdditionalPaymentActionRequest;
import com.onlinepayments.example.api.models.additionalpaymentactions.AdditionalPaymentActionResponse;
import com.onlinepayments.example.service.dtos.additionalpaymentactions.AdditionalPaymentActionRequestDto;
import com.onlinepayments.example.service.dtos.additionalpaymentactions.AdditionalPaymentActionResponseDto;
import org.mapstruct.Mapper;
import org.mapstruct.Mapping;

@Mapper(componentModel = "spring")
public interface AdditionalPaymentActionApiMapper {
    @Mapping(target = "id", source = "id")
    AdditionalPaymentActionRequestDto toDto(AdditionalPaymentActionRequest request, String id);

    AdditionalPaymentActionResponse toApiResponse(AdditionalPaymentActionResponseDto responseDto);
}
