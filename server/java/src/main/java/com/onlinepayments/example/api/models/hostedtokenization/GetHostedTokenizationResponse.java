package com.onlinepayments.example.api.models.hostedtokenization;

public record GetHostedTokenizationResponse(
        String hostedTokenizationId,
        String hostedTokenizationUrl
) { }
