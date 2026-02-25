package com.onlinepayments.example.api.mappers;

import com.onlinepayments.example.api.models.hostedcheckout.CreateHostedCheckoutRequest;
import com.onlinepayments.example.api.models.hostedcheckout.CreateHostedCheckoutResponse;
import com.onlinepayments.example.api.models.paymentbyhostedcheckoutid.GetPaymentByHostedCheckoutIdResponse;
import com.onlinepayments.example.service.dtos.hostedcheckout.CreateHostedCheckoutRequestDto;
import com.onlinepayments.example.service.dtos.hostedcheckout.CreateHostedCheckoutResponseDto;
import com.onlinepayments.example.service.dtos.paymentbyhostedcheckoutid.GetPaymentByHostedCheckoutIdResponseDto;
import org.mapstruct.Mapper;

@Mapper(componentModel = "spring")
public interface HostedCheckoutApiMapper {
    CreateHostedCheckoutRequestDto toCreateRequestDto(CreateHostedCheckoutRequest request);

    CreateHostedCheckoutResponse toApiCreateResponse(CreateHostedCheckoutResponseDto responseDto);

    GetPaymentByHostedCheckoutIdResponse toApiGetPaymentResponse(GetPaymentByHostedCheckoutIdResponseDto responseDto);
}
