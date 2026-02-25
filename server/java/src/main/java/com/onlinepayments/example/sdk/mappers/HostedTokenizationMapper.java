package com.onlinepayments.example.sdk.mappers;

import com.onlinepayments.domain.CreateHostedTokenizationResponse;
import com.onlinepayments.example.service.dtos.hostedtokenization.GetHostedTokenizationResponseDto;
import org.mapstruct.Mapper;
import org.mapstruct.Mapping;
import org.mapstruct.Mappings;

@Mapper(componentModel = "spring")

public interface HostedTokenizationMapper {
    @Mappings({
            @Mapping(target = "hostedTokenizationId", source = "hostedTokenizationId"),
            @Mapping(target = "hostedTokenizationUrl", source = "hostedTokenizationUrl"),
    })
    GetHostedTokenizationResponseDto toResponseDto(CreateHostedTokenizationResponse response);
}
