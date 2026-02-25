package com.onlinepayments.example.service.services;

import com.onlinepayments.example.service.dtos.hostedcheckout.CreateHostedCheckoutRequestDto;
import com.onlinepayments.example.service.dtos.hostedcheckout.CreateHostedCheckoutResponseDto;
import com.onlinepayments.example.service.dtos.paymentbyhostedcheckoutid.GetPaymentByHostedCheckoutIdResponseDto;
import com.onlinepayments.example.service.interfaces.clients.HostedCheckoutClientInterface;
import com.onlinepayments.example.service.interfaces.services.HostedCheckoutServiceInterface;
import org.springframework.stereotype.Service;

@Service
public class HostedCheckoutServiceImpl implements HostedCheckoutServiceInterface {

    private final HostedCheckoutClientInterface hostedCheckoutClient;

    public HostedCheckoutServiceImpl(HostedCheckoutClientInterface hostedCheckoutClient) {
        this.hostedCheckoutClient = hostedCheckoutClient;
    }

    @Override
    public CreateHostedCheckoutResponseDto createHostedCheckout(CreateHostedCheckoutRequestDto request) {
        CreateHostedCheckoutResponseDto responseDto = hostedCheckoutClient.createHostedCheckout(request);

        return new CreateHostedCheckoutResponseDto(
                responseDto.hostedCheckoutId(),
                responseDto.redirectUrl(),
                responseDto.returnMAC(),
                request.amount(),
                request.currency()
        );
    }

    @Override
    public GetPaymentByHostedCheckoutIdResponseDto getPaymentByHostedCheckoutId(String id) {
        return hostedCheckoutClient.getPaymentByHostedCheckoutId(id);
    }
}
