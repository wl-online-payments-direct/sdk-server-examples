package com.onlinepayments.example.service.services;

import com.onlinepayments.example.service.dtos.hostedtokenization.GetHostedTokenizationResponseDto;
import com.onlinepayments.example.service.interfaces.clients.HostedTokenizationClientInterface;
import com.onlinepayments.example.service.interfaces.services.HostedTokenizationServiceInterface;
import org.springframework.stereotype.Service;

@Service
public class HostedTokenizationServiceImpl implements HostedTokenizationServiceInterface {
    private final HostedTokenizationClientInterface hostedTokenizationClient;

    public HostedTokenizationServiceImpl(HostedTokenizationClientInterface hostedTokenizationClient) {
        this.hostedTokenizationClient = hostedTokenizationClient;
    }
    @Override
    public GetHostedTokenizationResponseDto initiateHostedTokenization() {
        return hostedTokenizationClient.initHostedTokenization();
    }
}
