package com.onlinepayments.example.service.dtos.hostedtokenization;

public record GetHostedTokenizationResponseDto(
        String hostedTokenizationId,
        String hostedTokenizationUrl
) { }
