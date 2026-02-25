package com.onlinepayments.example.api.mappers;

import com.onlinepayments.example.api.models.hostedtokenization.GetHostedTokenizationResponse;
import com.onlinepayments.example.service.dtos.hostedtokenization.GetHostedTokenizationResponseDto;
import org.mapstruct.Mapper;

@Mapper(componentModel = "spring")
public interface HostedTokenizationApiMapper {
    GetHostedTokenizationResponse toApiResponse(GetHostedTokenizationResponseDto responseDto);
}
