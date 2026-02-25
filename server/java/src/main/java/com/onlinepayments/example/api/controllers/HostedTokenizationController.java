package com.onlinepayments.example.api.controllers;

import com.onlinepayments.example.api.mappers.HostedTokenizationApiMapper;
import com.onlinepayments.example.api.models.hostedtokenization.GetHostedTokenizationResponse;
import com.onlinepayments.example.service.interfaces.services.HostedTokenizationServiceInterface;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@RequestMapping("/tokens")
public class HostedTokenizationController {
    private final HostedTokenizationServiceInterface hostedTokenizationService;
    private final HostedTokenizationApiMapper hostedTokenizationApiMapper;

    @Autowired
    public HostedTokenizationController(
            HostedTokenizationServiceInterface hostedTokenizationService,
            HostedTokenizationApiMapper hostedTokenizationApiMapper) {
        this.hostedTokenizationService = hostedTokenizationService;
        this.hostedTokenizationApiMapper = hostedTokenizationApiMapper;
    }

    @GetMapping
    public ResponseEntity<GetHostedTokenizationResponse> getHostedTokenization() {
        GetHostedTokenizationResponse response =
                hostedTokenizationApiMapper.toApiResponse(hostedTokenizationService.initiateHostedTokenization());

        return ResponseEntity.accepted().body(response);
    }
}
