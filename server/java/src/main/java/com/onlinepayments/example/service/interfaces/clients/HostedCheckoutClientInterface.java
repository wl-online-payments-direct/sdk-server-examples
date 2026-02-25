package com.onlinepayments.example.service.interfaces.clients;

import com.onlinepayments.example.service.dtos.hostedcheckout.CreateHostedCheckoutRequestDto;
import com.onlinepayments.example.service.dtos.hostedcheckout.CreateHostedCheckoutResponseDto;
import com.onlinepayments.example.service.dtos.paymentbyhostedcheckoutid.GetPaymentByHostedCheckoutIdResponseDto;

public interface HostedCheckoutClientInterface {
    CreateHostedCheckoutResponseDto createHostedCheckout(CreateHostedCheckoutRequestDto request);

    GetPaymentByHostedCheckoutIdResponseDto getPaymentByHostedCheckoutId(String id);
}