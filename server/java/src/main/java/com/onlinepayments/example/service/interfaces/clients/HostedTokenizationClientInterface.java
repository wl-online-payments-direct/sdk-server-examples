package com.onlinepayments.example.service.interfaces.clients;

import com.onlinepayments.example.service.dtos.hostedtokenization.GetHostedTokenizationResponseDto;

public interface HostedTokenizationClientInterface {
    GetHostedTokenizationResponseDto initHostedTokenization();
}