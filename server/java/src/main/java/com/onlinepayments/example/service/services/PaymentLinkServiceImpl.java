package com.onlinepayments.example.service.services;

import com.onlinepayments.example.service.dtos.paymentlinks.CreatePaymentLinkRequestDto;
import com.onlinepayments.example.service.dtos.paymentlinks.CreatePaymentLinkResponseDto;
import com.onlinepayments.example.service.interfaces.clients.PaymentLinkClientInterface;
import com.onlinepayments.example.service.interfaces.services.PaymentLinkServiceInterface;
import org.springframework.stereotype.Service;


@Service
public class PaymentLinkServiceImpl implements PaymentLinkServiceInterface {

    private final PaymentLinkClientInterface paymentLinkClient;

    public PaymentLinkServiceImpl(PaymentLinkClientInterface paymentLinkClient) {
        this.paymentLinkClient = paymentLinkClient;
    }

    @Override
    public CreatePaymentLinkResponseDto createPaymentLink(CreatePaymentLinkRequestDto request) {
        CreatePaymentLinkResponseDto responseDto = paymentLinkClient.createPaymentLink(request);

        return new CreatePaymentLinkResponseDto(
                responseDto.paymentLinkId(),
                responseDto.redirectUrl(),
                responseDto.status(),
                responseDto.amount(),
                responseDto.currency()
        );
    }
}
