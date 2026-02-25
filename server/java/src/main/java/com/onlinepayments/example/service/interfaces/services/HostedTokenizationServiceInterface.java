package com.onlinepayments.example.service.interfaces.services;

import com.onlinepayments.example.service.dtos.hostedtokenization.GetHostedTokenizationResponseDto;

public interface HostedTokenizationServiceInterface {
    GetHostedTokenizationResponseDto initiateHostedTokenization();
}
